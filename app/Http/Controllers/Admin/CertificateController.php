<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->paginate(10);
        return view('back.pages.certificate.index', compact('certificates'));
    }

    public function create()
    {
        return view('back.pages.certificate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text_az' => 'required',
            'text_en' => 'required',
            'text_ru' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/certificates');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                // Klasör yoksa oluştur
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['image'] = 'uploads/certificates/' . $webpFileName;
            }
        }

        $data['status'] = 1;
        Certificate::create($data);

        return redirect()->route('pages.certificate.index')
            ->with('success', 'Sertifikat uğurla əlavə edildi.');
    }

    public function edit(Certificate $certificate)
    {
        return view('back.pages.certificate.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'text_az' => 'required',
            'text_en' => 'required',
            'text_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($certificate->image && File::exists(public_path($certificate->image))) {
                File::delete(public_path($certificate->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/certificates');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                // Klasör yoksa oluştur
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['image'] = 'uploads/certificates/' . $webpFileName;
            }
        }

        $certificate->update($data);

        return redirect()->route('pages.certificate.index')
            ->with('success', 'Sertifikat uğurla yeniləndi.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image && File::exists(public_path($certificate->image))) {
            File::delete(public_path($certificate->image));
        }

        $certificate->delete();

        return redirect()->route('pages.certificate.index')
            ->with('success', 'Sertifikat uğurla silindi.');
    }

    public function toggleStatus(Certificate $certificate)
    {
        $certificate->update(['status' => !$certificate->status]);

        return redirect()->route('pages.certificate.index')
            ->with('success', 'Status uğurla dəyişdirildi.');
    }
}