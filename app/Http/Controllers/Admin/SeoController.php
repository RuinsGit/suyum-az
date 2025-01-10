<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seos = Seo::all();
        return view('back.admin.seo.index', compact('seos'));
    }

    public function create()
    {
        return view('back.admin.seo.create');
    }

    public function store(Request $request)
    {
        // Check if the number of existing records is 11
        if (Seo::count() >= 11) {
            return redirect()->route('pages.seo.index')->with('error', 'Maksimum 11 SEO məlumatı əlavə edilə bilər.');
        }

        $request->validate([
            'key' => 'required|unique:seos',
            'meta_title_az' => 'required',
            'meta_title_en' => 'required',
            'meta_title_ru' => 'required',
            'meta_description_az' => 'required',
            'meta_description_en' => 'required',
            'meta_description_ru' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        Seo::create($data);
        return redirect()->route('pages.seo.index')->with('success', 'SEO məlumatları uğurla əlavə edildi');
    }

    public function edit(Seo $seo)
    {
        return view('back.admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, Seo $seo)
    {
        $request->validate([
            'key' => 'required|unique:seos,key,' . $seo->id,
            'meta_title_az' => 'required',
            'meta_title_en' => 'required',
            'meta_title_ru' => 'required',
            'meta_description_az' => 'required',
            'meta_description_en' => 'required',
            'meta_description_ru' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        $seo->update($data);
        return redirect()->route('pages.seo.index')->with('success', 'SEO məlumatları uğurla yeniləndi');
    }

    public function destroy(Seo $seo)
    {
        $seo->delete();
        return redirect()->route('pages.seo.index')->with('success', 'SEO məlumatları uğurla silindi');
    }

    public function toggleStatus(Seo $seo)
    {
        $seo->update(['status' => !$seo->status]);
        
        return redirect()->route('pages.seo.index')->with('success', 'Status uğurla deaktiv edildi');
    }
}
