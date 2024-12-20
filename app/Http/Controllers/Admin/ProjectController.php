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
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except('_token', 'image', 'bottom_images');

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
            foreach ($request->file('bottom_images') as $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $bottomImages[] = $destinationPath . '/' . $fileName;
            }
            $data['bottom_images'] = $bottomImages;
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
            'bottom_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except('_token', '_method', 'image', 'bottom_images', 'remove_images');

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

        // Alt resimleri işleme
        if ($request->hasFile('bottom_images')) {
            $bottomImages = $project->bottom_images ?? [];
            
            foreach ($request->file('bottom_images') as $image) {
                $destinationPath = 'uploads/projects/gallery';
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path($destinationPath), $fileName);
                $bottomImages[] = $destinationPath . '/' . $fileName;
            }
            
            // Silinecek resimleri kaldır
            if ($request->has('remove_images')) {
                foreach ($request->remove_images as $key) {
                    $imageToRemove = $bottomImages[$key];
                    if (File::exists(public_path($imageToRemove))) {
                        File::delete(public_path($imageToRemove));
                    }
                    unset($bottomImages[$key]);
                }
                $bottomImages = array_values($bottomImages); // Array'i yeniden indexle
            }
            
            $data['bottom_images'] = $bottomImages;
        }

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