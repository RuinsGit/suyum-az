<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class LogoController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $logo = Logo::first();
        return view('back.admin.logo.index', compact('logo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        $logo = Logo::first();
        if (!$logo) {
            $logo = new Logo();
            $logo->status = true;
        } else {
            $logo->status = $request->has('status') ? 1 : 0;
        }

        if ($request->hasFile('logo')) {
            if ($logo->logo && File::exists(public_path($logo->logo))) {
                File::delete(public_path($logo->logo));
            }
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('uploads/logo'), $logoName);
            $logo->logo = 'uploads/logo/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            if ($logo->favicon && File::exists(public_path($logo->favicon))) {
                File::delete(public_path($logo->favicon));
            }
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move(public_path('uploads/logo'), $faviconName);
            $logo->favicon = 'uploads/logo/' . $faviconName;
        }

        $logo->status = $request->has('status') ? 1 : 0;
        $logo->save();

        return redirect()->back()->with('success', 'Logo ayarları başarıyla güncellendi.');
    }

    public function toggleStatus(Logo $logo)
    {
        $logo->update(['status' => !$logo->status]);
        
       return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }
} 