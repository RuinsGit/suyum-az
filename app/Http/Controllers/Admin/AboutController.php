<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('back.pages.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        // Gelen verileri kontrol için log'a yazalım
        \Log::info('Gelen veriler:', $request->all());

        $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:102400'
        ]);

        $about = About::first();
        if (!$about) {
            $about = new About();
            $about->save(); // Yeni kayıt oluşturulduğunda önce kaydedelim
        }

        $data = [
            'title_az' => $request->title_az,
            'title_en' => $request->title_en,
            'title_ru' => $request->title_ru,
            'description_az' => $request->description_az,
            'description_en' => $request->description_en,
            'description_ru' => $request->description_ru,
        ];

        // Video yükleme işlemi
        if ($request->hasFile('video')) {
            // Eski video varsa sil
            if ($about->video && file_exists(public_path($about->video))) {
                unlink(public_path($about->video));
            }

            $video = $request->file('video');
            $videoName = 'about_video_' . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/about'), $videoName);
            $data['video'] = 'uploads/about/' . $videoName;
        }

        // Güncelleme işlemini gerçekleştir
        $updated = $about->update($data);
        
        // Güncelleme sonucunu kontrol için log'a yazalım
        \Log::info('Güncelleme sonucu:', ['success' => $updated, 'data' => $data]);

        if ($updated) {
            return redirect()
                ->route('pages.about.index')
                ->with('success', 'Məlumatlar uğurla yeniləndi');
        } else {
            return back()
                ->with('error', 'Məlumatlar yenilənərkən xəta baş verdi')
                ->withInput();
        }
    }
}