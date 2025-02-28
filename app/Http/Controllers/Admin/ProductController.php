<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;




class ProductController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $categories = Category::all();
        
        $query = Product::with('category'); 

        
        if (request('search')) {
            $query->where(function($q) {
                $q->where('name_az', 'like', '%' . request('search') . '%')
                  ->orWhere('name_en', 'like', '%' . request('search') . '%')
                  ->orWhere('name_ru', 'like', '%' . request('search') . '%');
            });
        }

        
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

       
        if (request('status') !== null) {
            $query->where('status', request('status'));
        }

        $perPage = request('per_page', 15);

        $products = $query->latest()->paginate($perPage);

        
        foreach ($products as $product) {
            if ($product->annual_percentage > 0) {
                $product->additional_cost = round($product->price * ($product->annual_percentage / 100), 2);
            } else {
                $product->additional_cost = 0;
            }
        }

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
            'product_video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'main_image_meta_title_az' => 'nullable|string|max:255',
            'main_image_meta_title_en' => 'nullable|string|max:255',
            'main_image_meta_title_ru' => 'nullable|string|max:255',
            'main_image_meta_description_az' => 'nullable|string',
            'main_image_meta_description_en' => 'nullable|string',
            'main_image_meta_description_ru' => 'nullable|string',
        ]);

        $data = $request->all();
        
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['has_courier'] = $request->has('has_courier') ? 1 : 0;
        $data['has_installation'] = $request->has('has_installation') ? 1 : 0;
        $data['is_new'] = $request->has('is_new') ? 1 : 0;

        if ($request->has('installment_months')) {
            $data['installment_months'] = implode(',', $request->installment_months);
        }

        if ($request->hasFile('product_video')) {
            $file = $request->file('product_video');
            $destinationPath = public_path('uploads/products');
            
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $videoFileName = time() . '_' . $originalFileName . '_video.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $videoFileName);
            
            $data['product_video'] = 'uploads/products/' . $videoFileName;
        }

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

        $data['discount'] = $request->input('discount', 0); 

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
            'cartridge_az' => 'nullable|string|max:255',
            'cartridge_en' => 'nullable|string|max:255',
            'cartridge_ru' => 'nullable|string|max:255',
            'pressure_range_az' => 'nullable|string|max:255',
            'pressure_range_en' => 'nullable|string|max:255',
            'pressure_range_ru' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'annual_percentage' => 'required|numeric|min:0|max:100',
            'courier_price' => 'required_if:has_courier,1|nullable|numeric|min:0',
            'installation_price' => 'required_if:has_installation,1|nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20480',
            'courier_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'installation_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'payment_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'payment_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'discount' => 'nullable|numeric|min:0|max:100',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
            'main_image_meta_title_az' => 'nullable|string|max:255',
            'main_image_meta_title_en' => 'nullable|string|max:255',
            'main_image_meta_title_ru' => 'nullable|string|max:255',
            'main_image_meta_description_az' => 'nullable|string',
            'main_image_meta_description_en' => 'nullable|string',
            'main_image_meta_description_ru' => 'nullable|string',
        ]);

        try {
            $product = Product::findOrFail($id);
            $data = $request->except(['_token', '_method']);
            
            $data['status'] = $request->has('status') ? 1 : 0;
            $data['has_courier'] = $request->has('has_courier') ? 1 : 0;
            $data['has_installation'] = $request->has('has_installation') ? 1 : 0;
            $data['is_new'] = $request->has('is_new') ? 1 : 0;

            if ($request->has('installment_months')) {
                $data['installment_months'] = implode(',', $request->installment_months);
            } else {
                $data['installment_months'] = null;
            }

            if ($request->hasFile('product_video')) {
                if ($product->product_video && File::exists(public_path($product->product_video))) {
                    File::delete(public_path($product->product_video));
                }

                $file = $request->file('product_video');
                $destinationPath = public_path('uploads/products');
                
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0777, true);
                }
                
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $videoFileName = time() . '_' . $originalFileName . '_video.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $videoFileName);
                
                $data['product_video'] = 'uploads/products/' . $videoFileName;
            }

            $imageFields = ['main_image', 'courier_image', 'installation_image', 'payment_image_1', 'payment_image_2'];
            
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    if ($product->$field && File::exists(public_path($product->$field))) {
                        File::delete(public_path($product->$field));
                    }

                    $file = $request->file($field);
                    $destinationPath = public_path('uploads/products');
                    
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0777, true);
                    }

                    $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $webpFileName = time() . '_' . $originalFileName . '_' . $field . '.webp';
                    $webpPath = $destinationPath . '/' . $webpFileName;

                    $imageResource = imagecreatefromstring(file_get_contents($file));
                    if ($imageResource) {
                        imagewebp($imageResource, $webpPath, 80);
                        imagedestroy($imageResource);
                        $data[$field] = 'uploads/products/' . $webpFileName;
                    }
                }
            }

            if (!$data['has_courier']) {
                $data['courier_price'] = null;
                $data['courier_image'] = $product->courier_image; 
            }
            
            if (!$data['has_installation']) {
                $data['installation_price'] = null;
                $data['installation_image'] = $product->installation_image; 
            }

            $data['discount'] = $request->input('discount', 0); 

            $product->update($data);
            return redirect()->route('pages.product.index')->with('success', 'Məhsul uğurla yeniləndi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Xəta: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $imageFields = ['main_image', 'courier_image', 'installation_image', 'payment_image_1', 'payment_image_2', 'product_video'];
        foreach ($imageFields as $field) {
            if ($product->$field && File::exists(public_path($product->$field))) {
                File::delete(public_path($product->$field));
            }
        }

        $product->delete();

        return redirect()->route('pages.product.index')
            ->with('success', 'Məhsul uğurla silindi.');
    }

    public function deleteImage(Product $product, $type)
    {
        $validTypes = ['main_image', 'courier_image', 'installation_image', 'payment_image_1', 'payment_image_2'];

        if (!in_array($type, $validTypes)) {
            return response()->json(['success' => false, 'message' => 'Seçilən resim tipi mövcud deyil'], 400);
        }

        if ($product->$type && File::exists(public_path($product->$type))) {
            File::delete(public_path($product->$type));
            $product->update([$type => null]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Sekil tapilmadi'], 404);
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();

        return redirect()->route('pages.product.index')
            ->with('success', 'Məhsul statusu uğurla dəyişdirildi.');
    }
} 