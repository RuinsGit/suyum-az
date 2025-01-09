<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('back.pages.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('back.pages.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = public_path('uploads/customers');
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
                $data['image'] = 'uploads/customers/' . $webpFileName;
            }
        }

        Customer::create($data);

        return redirect()->route('pages.customer.index')
            ->with('success', 'Müştəri uğurla əlavə edildi.');
    }

    public function edit(Customer $customer)
    {
        return view('back.pages.customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
            'image_alt_az' => 'nullable|string|max:255',
            'image_alt_en' => 'nullable|string|max:255',
            'image_alt_ru' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Köhnə şəkili sil
            if ($customer->image && File::exists(public_path($customer->image))) {
                File::delete(public_path($customer->image));
            }

            $file = $request->file('image');
            $destinationPath = public_path('uploads/customers');
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
                $data['image'] = 'uploads/customers/' . $webpFileName;
            }
        }

        $customer->update($data);

        return redirect()->route('pages.customer.index')
            ->with('success', 'Müştəri uğurla yeniləndi.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->image && File::exists(public_path($customer->image))) {
            File::delete(public_path($customer->image));
        }

        $customer->delete();

        return redirect()->route('pages.customer.index')
            ->with('success', 'Müştəri uğurla silindi.');
    }

    public function toggleStatus(Customer $customer)
    {
        $customer->status = !$customer->status;
        $customer->save();
        
        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi');
    }
}