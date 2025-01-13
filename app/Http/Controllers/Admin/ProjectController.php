<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class ProjectController extends Controller
{
    public function index()
    {
        
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
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
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

        // Alt resimler ve ALT etiketleri
        $bottomImages = [];
        $bottomImagesAlt = ['az' => [], 'en' => [], 'ru' => []];

        if ($request->hasFile('bottom_images')) {
            foreach ($request->file('bottom_images') as $key => $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $bottomImages[] = $destinationPath . '/' . $fileName;

                // ALT etiketlerini kaydet
                $bottomImagesAlt['az'][] = $request->input("bottom_images_alt.az.{$key}") ?? '';
                $bottomImagesAlt['en'][] = $request->input("bottom_images_alt.en.{$key}") ?? '';
                $bottomImagesAlt['ru'][] = $request->input("bottom_images_alt.ru.{$key}") ?? '';
            }
        }

        $data['bottom_images'] = $bottomImages;
        $data['bottom_images_alt'] = $bottomImagesAlt;

        // Yeni meta alanlarını ekle
        $data['meta_title_az'] = $request->input('meta_title_az');
        $data['meta_title_en'] = $request->input('meta_title_en');
        $data['meta_title_ru'] = $request->input('meta_title_ru');
        $data['meta_description_az'] = $request->input('meta_description_az');
        $data['meta_description_en'] = $request->input('meta_description_en');
        $data['meta_description_ru'] = $request->input('meta_description_ru');

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
            'meta_title_az' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_description_az' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'meta_description_ru' => 'nullable|string',
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

        // Mevcut alt resimler ve ALT etiketleri
        $bottomImages = $project->bottom_images ?? [];
        $bottomImagesAlt = $project->bottom_images_alt;

        // Yeni yüklenen resimler
        if ($request->hasFile('bottom_images')) {
            foreach ($request->file('bottom_images') as $key => $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $newKey = count($bottomImages);
                $bottomImages[] = $destinationPath . '/' . $fileName;

                // Yeni resimler için ALT etiketleri
                $bottomImagesAlt['az'][$newKey] = $request->input("bottom_images_alt.az.{$key}") ?? '';
                $bottomImagesAlt['en'][$newKey] = $request->input("bottom_images_alt.en.{$key}") ?? '';
                $bottomImagesAlt['ru'][$newKey] = $request->input("bottom_images_alt.ru.{$key}") ?? '';
            }
        }

        // Mevcut resimlerin ALT etiketlerini güncelle
        if ($request->has('bottom_images_alt')) {
            foreach ($bottomImages as $key => $image) {
                $bottomImagesAlt['az'][$key] = $request->input("bottom_images_alt.az.{$key}", $bottomImagesAlt['az'][$key] ?? '');
                $bottomImagesAlt['en'][$key] = $request->input("bottom_images_alt.en.{$key}", $bottomImagesAlt['en'][$key] ?? '');
                $bottomImagesAlt['ru'][$key] = $request->input("bottom_images_alt.ru.{$key}", $bottomImagesAlt['ru'][$key] ?? '');
            }
        }

        $data['bottom_images'] = array_values($bottomImages);
        $data['bottom_images_alt'] = $bottomImagesAlt;

        // Yeni meta alanlarını güncelle
        $data['meta_title_az'] = $request->input('meta_title_az');
        $data['meta_title_en'] = $request->input('meta_title_en');
        $data['meta_title_ru'] = $request->input('meta_title_ru');
        $data['meta_description_az'] = $request->input('meta_description_az');
        $data['meta_description_en'] = $request->input('meta_description_en');
        $data['meta_description_ru'] = $request->input('meta_description_ru');

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