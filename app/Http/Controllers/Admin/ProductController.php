<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        $query = Product::with('category'); // Eager loading for performance

        // Search filter
        if (request('search')) {
            $query->where(function($q) {
                $q->where('name_az', 'like', '%' . request('search') . '%')
                  ->orWhere('name_en', 'like', '%' . request('search') . '%')
                  ->orWhere('name_ru', 'like', '%' . request('search') . '%');
            });
        }

        // Category filter
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        // Status filter
        if (request('status') !== null) {
            $query->where('status', request('status'));
        }

        $products = $query->latest()->paginate(10);

        return view('back.pages.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('back.pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'annual_percentage' => 'required|numeric|min:0|max:100',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        
        // Boolean değerleri düzelt
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['has_courier'] = $request->has('has_courier') ? 1 : 0;
        $data['has_installation'] = $request->has('has_installation') ? 1 : 0;

        // Taksit aylarını string olarak kaydet
        if ($request->has('installment_months')) {
            $data['installment_months'] = implode(',', $request->installment_months);
        }

        // Ana resim
        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $destinationPath = public_path('uploads/products');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '_main_image.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['main_image'] = 'uploads/products/' . $webpFileName;
            }
        }

        // Kuryer resmi
        if ($request->hasFile('courier_image')) {
            $file = $request->file('courier_image');
            $destinationPath = public_path('uploads/products');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '_courier_image.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['courier_image'] = 'uploads/products/' . $webpFileName;
            }
        }

        // Quraşdırma resmi
        if ($request->hasFile('installation_image')) {
            $file = $request->file('installation_image');
            $destinationPath = public_path('uploads/products');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '_installation_image.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['installation_image'] = 'uploads/products/' . $webpFileName;
            }
        }

        // Ödəniş resmi 1
        if ($request->hasFile('payment_image_1')) {
            $file = $request->file('payment_image_1');
            $destinationPath = public_path('uploads/products');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '_payment_image_1.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['payment_image_1'] = 'uploads/products/' . $webpFileName;
            }
        }

        // Ödəniş resmi 2
        if ($request->hasFile('payment_image_2')) {
            $file = $request->file('payment_image_2');
            $destinationPath = public_path('uploads/products');
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $webpFileName = time() . '_' . $originalFileName . '_payment_image_2.webp';

            $imageResource = imagecreatefromstring(file_get_contents($file));
            $webpPath = $destinationPath . '/' . $webpFileName;

            if ($imageResource) {
                imagewebp($imageResource, $webpPath, 80);
                imagedestroy($imageResource);

                $data['payment_image_2'] = 'uploads/products/' . $webpFileName;
            }
        }

        try {
            Product::create($data);
            return redirect()->route('pages.product.index')->with('success', 'Məhsul uğurla əlavə edildi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Məhsul əlavə edilərkən xəta baş verdi: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        return view('back.pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name_az' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'monthly_percentage' => 'required|numeric|min:0|max:100',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'courier_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'installation_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'payment_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'payment_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();
        
        // Boolean değerleri düzelt
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['has_courier'] = $request->has('has_courier') ? 1 : 0;
        $data['has_installation'] = $request->has('has_installation') ? 1 : 0;

        // Resim işlemleri
        $imageFields = ['main_image', 'courier_image', 'installation_image', 'payment_image_1', 'payment_image_2'];
        
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Eski resmi sil
                if ($product->$field && File::exists(public_path($product->$field))) {
                    File::delete(public_path($product->$field));
                }

                $file = $request->file($field);
                $destinationPath = public_path('uploads/products');
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $webpFileName = time() . '_' . $originalFileName . '_' . $field . '.webp';

                $imageResource = imagecreatefromstring(file_get_contents($file));
                $webpPath = $destinationPath . '/' . $webpFileName;

                if ($imageResource) {
                    imagewebp($imageResource, $webpPath, 80);
                    imagedestroy($imageResource);

                    $data[$field] = 'uploads/products/' . $webpFileName;
                }
            }
        }

        $product->update($data);

        return redirect()->route('pages.product.index')
            ->with('success', 'Məhsul uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Tüm resimleri sil
        $imageFields = ['main_image', 'courier_image', 'installation_image', 'payment_image_1', 'payment_image_2'];
        foreach ($imageFields as $field) {
            if ($product->$field && File::exists(public_path($product->$field))) {
                File::delete(public_path($product->$field));
            }
        }

        $product->delete();

        return redirect()->route('pages.product.index')
            ->with('success', 'Məhsul uğurla silindi.');
    }
} 