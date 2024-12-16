<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    public function index()
    {
        $translation = Translation::first();
        return view('back.admin.translation.index', compact('translation'));
    }

    public function update(Request $request)
    {
        $translation = Translation::first();
        if (!$translation) {
            $translation = new Translation();
        }

        // Logo işlemi
        if ($request->hasFile('logo')) {
            // Eski logo varsa sil
            if ($translation->logo && File::exists(public_path($translation->logo))) {
                File::delete(public_path($translation->logo));
            }

            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/translations'), $logoName);
            $translation->logo = 'uploads/translations/' . $logoName;
        }

        // Text alanları için döngü
        for ($i = 1; $i <= 8; $i++) {
            $translation->{'text' . $i . '_az'} = $request->{'text' . $i . '_az'};
            $translation->{'text' . $i . '_en'} = $request->{'text' . $i . '_en'};
            $translation->{'text' . $i . '_ru'} = $request->{'text' . $i . '_ru'};
        }

        $translation->save();

        return redirect()->route('pages.translations.index')->with('success', 'Çeviriler başarıyla güncellendi');
    }
}