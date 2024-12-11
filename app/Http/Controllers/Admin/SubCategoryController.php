<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->paginate(10);
        return view('back.pages.subcategory.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('back.pages.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name_az' => $request->name_az,
            'name_en' => $request->name_en,
            'name_ru' => $request->name_ru,
            'status' => $request->has('status'),
        ]);

        return redirect()
            ->route('pages.subcategory.index')
            ->with('success', 'Alt kateqoriya uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('back.pages.subcategory.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        $subCategory->update($data);

        return redirect()->route('pages.subcategory.index')
            ->with('success', 'Alt kateqoriya uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('pages.subcategory.index')
            ->with('success', 'Alt kateqoriya uğurla silindi.');
    }

    public function toggleStatus($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->status = !$subCategory->status;
        $subCategory->save();

        return redirect()->route('pages.subcategory.index')
            ->with('success', 'Alt kateqoriya statusu uğurla dəyişdirildi.');
    }

    public function getSubCategories($categoryId)
    {
        try {
            $subCategories = SubCategory::where('category_id', $categoryId)
                ->where('status', 1)
                ->select('id', 'name_az')
                ->get();
            
            return response()->json($subCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}