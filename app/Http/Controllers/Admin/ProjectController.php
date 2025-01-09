<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;


class ProjectController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $projects = Project::latest()->paginate(10);
        return view('back.pages.project.index', compact('projects'));
    }

    public function create()
    {
        return view('back.pages.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name_az' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text1_az' => 'nullable|string',
            'text1_en' => 'nullable|string',
            'text1_ru' => 'nullable|string',
            'text2_az' => 'nullable|string',
            'text2_en' => 'nullable|string',
            'text2_ru' => 'nullable|string',
            'description1_az' => 'nullable|string',
            'description1_en' => 'nullable|string',
            'description1_ru' => 'nullable|string',
            'description2_az' => 'nullable|string',
            'description2_en' => 'nullable|string',
            'description2_ru' => 'nullable|string',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_images_alt.az.*' => 'nullable|string|max:255',
            'bottom_images_alt.en.*' => 'nullable|string|max:255',
            'bottom_images_alt.ru.*' => 'nullable|string|max:255',
        ]);

        $data = $request->except('_token', 'image', 'bottom_images', 'bottom_images_alt');

        // Ana resim işleme
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = 'uploads/projects';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($destinationPath), $fileName);
            $data['image'] = $destinationPath . '/' . $fileName;
        }

        // Alt resimleri işleme
        if ($request->hasFile('bottom_images')) {
            $bottomImages = [];
            $bottomImagesAlt = [
                'az' => [],
                'en' => [],
                'ru' => []
            ];

            foreach ($request->file('bottom_images') as $key => $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $bottomImages[] = $destinationPath . '/' . $fileName;

                // ALT etiketlerini kaydet
                $bottomImagesAlt['az'][] = $request->input('bottom_images_alt.az.' . $key);
                $bottomImagesAlt['en'][] = $request->input('bottom_images_alt.en.' . $key);
                $bottomImagesAlt['ru'][] = $request->input('bottom_images_alt.ru.' . $key);
            }

            $data['bottom_images'] = $bottomImages;
            $data['bottom_images_alt'] = $bottomImagesAlt;
        }

        Project::create($data);

        return redirect()->route('pages.project.index')
            ->with('success', 'Layihə uğurla əlavə edildi.');
    }

    public function edit(Project $project)
    {
        return view('back.pages.project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name_az' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'name_ru' => 'nullable|string|max:255',
            'text1_az' => 'nullable|string',
            'text1_en' => 'nullable|string',
            'text1_ru' => 'nullable|string',
            'text2_az' => 'nullable|string',
            'text2_en' => 'nullable|string',
            'text2_ru' => 'nullable|string',
            'description1_az' => 'nullable|string',
            'description1_en' => 'nullable|string',
            'description1_ru' => 'nullable|string',
            'description2_az' => 'nullable|string',
            'description2_en' => 'nullable|string',
            'description2_ru' => 'nullable|string',
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'bottom_images_alt.az.*' => 'nullable|string|max:255',
            'bottom_images_alt.en.*' => 'nullable|string|max:255',
            'bottom_images_alt.ru.*' => 'nullable|string|max:255',
            'existing_images_alt.az.*' => 'nullable|string|max:255',
            'existing_images_alt.en.*' => 'nullable|string|max:255',
            'existing_images_alt.ru.*' => 'nullable|string|max:255',
        ]);

        $data = $request->except('_token', '_method', 'image', 'bottom_images', 'bottom_images_alt', 'existing_images_alt', 'remove_images');

        // Ana resim işleme
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($project->image && File::exists(public_path($project->image))) {
                File::delete(public_path($project->image));
            }

            $file = $request->file('image');
            $destinationPath = 'uploads/projects';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($destinationPath), $fileName);
            $data['image'] = $destinationPath . '/' . $fileName;
        }

        // Alt resimleri ve ALT etiketlerini işleme
        $bottomImages = $project->bottom_images ?? [];
        $bottomImagesAlt = $project->bottom_images_alt ?? ['az' => [], 'en' => [], 'ru' => []];

        // Mevcut resimlerin ALT etiketlerini güncelle
        if ($request->has('existing_images_alt')) {
            foreach (['az', 'en', 'ru'] as $lang) {
                foreach ($request->existing_images_alt[$lang] ?? [] as $key => $alt) {
                    $bottomImagesAlt[$lang][$key] = $alt;
                }
            }
        }

        // Yeni resimleri ve ALT etiketlerini ekle
        if ($request->hasFile('bottom_images')) {
            foreach ($request->file('bottom_images') as $key => $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $newKey = count($bottomImages);
                $bottomImages[] = $destinationPath . '/' . $fileName;

                // Yeni ALT etiketlerini ekle
                $bottomImagesAlt['az'][$newKey] = $request->input('bottom_images_alt.az.' . $key);
                $bottomImagesAlt['en'][$newKey] = $request->input('bottom_images_alt.en.' . $key);
                $bottomImagesAlt['ru'][$newKey] = $request->input('bottom_images_alt.ru.' . $key);
            }
        }

        // Silinecek resimleri ve ALT etiketlerini kaldır
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $key) {
                $imageToRemove = $bottomImages[$key];
                if (File::exists(public_path($imageToRemove))) {
                    File::delete(public_path($imageToRemove));
                }
                unset($bottomImages[$key]);
                unset($bottomImagesAlt['az'][$key]);
                unset($bottomImagesAlt['en'][$key]);
                unset($bottomImagesAlt['ru'][$key]);
            }
            $bottomImages = array_values($bottomImages);
            $bottomImagesAlt['az'] = array_values($bottomImagesAlt['az']);
            $bottomImagesAlt['en'] = array_values($bottomImagesAlt['en']);
            $bottomImagesAlt['ru'] = array_values($bottomImagesAlt['ru']);
        }

        $data['bottom_images'] = $bottomImages;
        $data['bottom_images_alt'] = $bottomImagesAlt;

        $project->update($data);

        return redirect()->route('pages.project.index')
            ->with('success', 'Layihə uğurla yeniləndi.');
    }

    public function destroy(Project $project)
    {
        // Ana resmi sil
        if ($project->image && File::exists(public_path($project->image))) {
            File::delete(public_path($project->image));
        }

        // Alt resimleri sil
        if ($project->bottom_images) {
            foreach ($project->bottom_images as $image) {
                if (File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }

        $project->delete();

        return redirect()->route('pages.project.index')
            ->with('success', 'Layihə uğurla silindi.');
    }

    public function toggleStatus(Project $project)
    {
        $project->status = !$project->status;
        $project->save();
        
        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi.');
    }
}