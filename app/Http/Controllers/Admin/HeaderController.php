<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::paginate(10);
        return view('back.pages.header.index', compact('headers'));
    }

    public function create()
    {
        if (Header::count() > 0) {
            return redirect()->route('pages.header.index')
                ->with('error', 'Artıq başlıq mövcuddur. Yalnız mövcud başlığı redaktə edə bilərsiniz.');
        }

        return view('back.pages.header.create');
    }

    public function store(Request $request)
    {
        if (Header::count() > 0) {
            return redirect()->route('pages.header.index')
                ->with('error', 'Artıq başlıq mövcuddur. Yalnız mövcud başlığı redaktə edə bilərsiniz.');
        }

        $request->validate([
            'home_az' => 'nullable|string',
            'home_en' => 'nullable|string',
            'home_ru' => 'nullable|string',
            'about_az' => 'nullable|string',
            'about_en' => 'nullable|string',
            'about_ru' => 'nullable|string',
            'products_az' => 'nullable|string',
            'products_en' => 'nullable|string',
            'products_ru' => 'nullable|string',
            'services_az' => 'nullable|string',
            'services_en' => 'nullable|string',
            'services_ru' => 'nullable|string',
            'projects_az' => 'nullable|string',
            'projects_en' => 'nullable|string',
            'projects_ru' => 'nullable|string',
            'certificates_az' => 'nullable|string',
            'certificates_en' => 'nullable|string',
            'certificates_ru' => 'nullable|string',
            'customers_az' => 'nullable|string',
            'customers_en' => 'nullable|string',
            'customers_ru' => 'nullable|string',
            'contact_az' => 'nullable|string',
            'contact_en' => 'nullable|string',
            'contact_ru' => 'nullable|string'
        ]);

        Header::create($request->all());

        return redirect()->route('pages.header.index')
            ->with('success', 'Başlıq uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $header = Header::findOrFail($id);
        return view('back.pages.header.edit', compact('header'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'home_az' => 'nullable|string',
            'home_en' => 'nullable|string',
            'home_ru' => 'nullable|string',
            'about_az' => 'nullable|string',
            'about_en' => 'nullable|string',
            'about_ru' => 'nullable|string',
            'products_az' => 'nullable|string',
            'products_en' => 'nullable|string',
            'products_ru' => 'nullable|string',
            'services_az' => 'nullable|string',
            'services_en' => 'nullable|string',
            'services_ru' => 'nullable|string',
            'projects_az' => 'nullable|string',
            'projects_en' => 'nullable|string',
            'projects_ru' => 'nullable|string',
            'certificates_az' => 'nullable|string',
            'certificates_en' => 'nullable|string',
            'certificates_ru' => 'nullable|string',
            'customers_az' => 'nullable|string',
            'customers_en' => 'nullable|string',
            'customers_ru' => 'nullable|string',
            'contact_az' => 'nullable|string',
            'contact_en' => 'nullable|string',
            'contact_ru' => 'nullable|string'
        ]);

        $header = Header::findOrFail($id);
        $header->update($request->all());

        return redirect()->route('pages.header.index')->with('success', 'Başlıq uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        try {
            $header = Header::findOrFail($id);
            $header->delete();
            return redirect()->route('pages.header.index')->with('success', 'Başlıq uğurla silindi.');
        } catch (\Exception $e) {
            return redirect()->route('pages.header.index')->with('error', 'Xəta baş verdi!');
        }
    }
}