<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class CategoryController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $categories = Category::paginate(10);
        return view('back.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('back.pages.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'description_az' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_image_alt_az' => 'nullable|string|max:255',
            'button_image_alt_en' => 'nullable|string|max:255',
            'button_image_alt_ru' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/categories');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['image'] = 'uploads/categories/' . $webpFileName;
            }
        }

        // Button resmi yükleme
        if ($request->hasFile('button_image')) {
            $buttonFile = $request->file('button_image');
            $destinationPath = public_path('uploads/categories');
            $originalFileName = pathinfo($buttonFile->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_button_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($buttonFile));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['button_image'] = 'uploads/categories/' . $webpFileName;
            }
        }

        Category::create($data);

        return redirect()->route('pages.category.index')
            ->with('success', 'Kateqoriya uğurla əlavə edildi.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('back.pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'description_az' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ru' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_image_alt_az' => 'nullable|string|max:255',
            'button_image_alt_en' => 'nullable|string|max:255',
            'button_image_alt_ru' => 'nullable|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/categories');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['image'] = 'uploads/categories/' . $webpFileName;
            }
        }

        // Button resmi güncelleme
        if ($request->hasFile('button_image')) {
            // Eski button resmini sil
            if ($category->button_image && File::exists(public_path($category->button_image))) {
                File::delete(public_path($category->button_image));
            }

            $buttonFile = $request->file('button_image');
            $destinationPath = public_path('uploads/categories');
            $originalFileName = pathinfo($buttonFile->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_button_' . $originalFileName . '.webp';

            $imageResource = imagecreatefromstring(file_get_contents($buttonFile));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['button_image'] = 'uploads/categories/' . $webpFileName;
            }
        }

        $category->update($data);

        return redirect()->route('pages.category.index')
            ->with('success', 'Kateqoriya uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Ana resmi sil
        if ($category->image && File::exists(public_path($category->image))) {
            File::delete(public_path($category->image));
        }

        // Button resmini sil
        if ($category->button_image && File::exists(public_path($category->button_image))) {
            File::delete(public_path($category->button_image));
        }

        $category->delete();

        return redirect()->route('pages.category.index')
            ->with('success', 'Kateqoriya uğurla silindi.');
    }

    public function toggleStatus(Category $category)
    {
        try {
            $category->status = !$category->status;
            $category->save();
            
            return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xəta baş verdi');
        }
    }
}