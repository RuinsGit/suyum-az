<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('back.pages.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1_az' => 'required|string|max:255',
            'title1_en' => 'required|string|max:255',
            'title1_ru' => 'required|string|max:255',
            'title2_az' => 'required|string|max:255',
            'title2_en' => 'required|string|max:255',
            'title2_ru' => 'required|string|max:255',
            'description_az' => 'required',
            'description_en' => 'required',
            'description_ru' => 'required',
            'number' => 'required|string|max:255',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $contact = Contact::first();
        if (!$contact) {
            $contact = new Contact();
        }

        $data = $request->all();
        
        // Image 1
        if ($request->hasFile('image1')) {
            if ($contact->image1 && File::exists(public_path($contact->image1))) {
                File::delete(public_path($contact->image1));
            }
            $file = $request->file('image1');
            $fileName = time() . '_1_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/contact'), $fileName);
            $data['image1'] = 'uploads/contact/' . $fileName;
        }

        // Image 2
        if ($request->hasFile('image2')) {
            if ($contact->image2 && File::exists(public_path($contact->image2))) {
                File::delete(public_path($contact->image2));
            }
            $file = $request->file('image2');
            $fileName = time() . '_2_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/contact'), $fileName);
            $data['image2'] = 'uploads/contact/' . $fileName;
        }

        // Image 3
        if ($request->hasFile('image3')) {
            if ($contact->image3 && File::exists(public_path($contact->image3))) {
                File::delete(public_path($contact->image3));
            }
            $file = $request->file('image3');
            $fileName = time() . '_3_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/contact'), $fileName);
            $data['image3'] = 'uploads/contact/' . $fileName;
        }

        $data['status'] = 1;

        if ($contact->exists) {
            $contact->update($data);
        } else {
            Contact::create($data);
        }

        return redirect()->back()->with('success', 'Əlaqə məlumatları uğurla yeniləndi.');
    }
}