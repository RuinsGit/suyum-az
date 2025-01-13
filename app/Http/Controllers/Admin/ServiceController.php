<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;




class ServiceController extends Controller
{
    public function index()
    {
        
        $services = Service::latest()->paginate(10);
        return view('back.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('back.pages.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_az' => 'required',
            'title_en' => 'required',
            'title_ru' => 'required',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bottom_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_image_alt_az' => 'nullable|string|max:255',
            'bottom_image_alt_en' => 'nullable|string|max:255',
            'bottom_image_alt_ru' => 'nullable|string|max:255',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
        ]);

        $data = $request->all();

        // Ana resim işleme
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/services');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
                $data['image'] = 'uploads/services/' . $webpFileName;
            }
        }

        // Alt resim işleme
        if ($request->hasFile('bottom_image')) {
            $file = $request->file('bottom_image');
            $destinationPath = public_path('uploads/services');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_bottom_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
                $data['bottom_image'] = 'uploads/services/' . $webpFileName;
            }
        }

        // Yeni meta alanlarını ekle
        $data['meta_title_az'] = $request->input('meta_title_az');
        $data['meta_title_en'] = $request->input('meta_title_en');
        $data['meta_title_ru'] = $request->input('meta_title_ru');
        $data['meta_description_az'] = $request->input('meta_description_az');
        $data['meta_description_en'] = $request->input('meta_description_en');
        $data['meta_description_ru'] = $request->input('meta_description_ru');

        Service::create($data);

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla əlavə edildi.');
    }

    public function edit(Service $service)
    {
        return view('back.pages.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title_az' => 'required',
            'title_en' => 'required',
            'title_ru' => 'required',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'bottom_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_image_alt_az' => 'nullable|string|max:255',
            'bottom_image_alt_en' => 'nullable|string|max:255',
            'bottom_image_alt_ru' => 'nullable|string|max:255',
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
        ]);

        $data = $request->all();

        // Ana resim işleme
        if ($request->hasFile('image')) {
            if ($service->image && File::exists(public_path($service->image))) {
                File::delete(public_path($service->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/services');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
                $data['image'] = 'uploads/services/' . $webpFileName;
            }
        }

        // Alt resim işleme
        if ($request->hasFile('bottom_image')) {
            if ($service->bottom_image && File::exists(public_path($service->bottom_image))) {
                File::delete(public_path($service->bottom_image));
            }

            $file = $request->file('bottom_image');
            $destinationPath = public_path('uploads/services');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_bottom_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);
                $data['bottom_image'] = 'uploads/services/' . $webpFileName;
            }
        }

        // Yeni meta alanlarını güncelle
        $data['meta_title_az'] = $request->input('meta_title_az');
        $data['meta_title_en'] = $request->input('meta_title_en');
        $data['meta_title_ru'] = $request->input('meta_title_ru');
        $data['meta_description_az'] = $request->input('meta_description_az');
        $data['meta_description_en'] = $request->input('meta_description_en');
        $data['meta_description_ru'] = $request->input('meta_description_ru');

        $service->update($data);

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla yeniləndi.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && File::exists(public_path($service->image))) {
            File::delete(public_path($service->image));
        }
        if ($service->bottom_image && File::exists(public_path($service->bottom_image))) {
            File::delete(public_path($service->bottom_image));
        }

        $service->delete();

        return redirect()->route('pages.service.index')
            ->with('success', 'Xidmət uğurla silindi.');
    }

    public function toggleStatus(Service $service)
    {
        $service->status = !$service->status;
        $service->save();
        
        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }
}