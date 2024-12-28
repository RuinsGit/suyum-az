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
        
        $contacts = Contact::all();
        return view('back.pages.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('back.pages.contact.create');
    }

    public function store(Request $request)
    {
        // Debug için request verilerini görelim
        \Log::info('Contact store request:', $request->all());

        $request->validate([
            'name_az' => 'required|string|max:255',
            'number_az' => 'required|string|max:255',
            'address_az' => 'required|string|max:255',
            'email_az' => 'required|email|max:255',
            'name_en' => 'required|string|max:255',
            'number_en' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'email_en' => 'required|email|max:255',
            'name_ru' => 'required|string|max:255',
            'number_ru' => 'required|string|max:255',
            'address_ru' => 'required|string|max:255',
            'email_ru' => 'required|email|max:255',
            'number_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'address_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            
            'filial_text_az' => 'nullable|string',
            'filial_text_en' => 'nullable|string',
            'filial_text_ru' => 'nullable|string',
        ]);

        try {
            $data = $request->only([
                'name_az', 'number_az', 'address_az', 'email_az',
                'name_en', 'number_en', 'address_en', 'email_en',
                'name_ru', 'number_ru', 'address_ru', 'email_ru',
                'filial_text_az', 'filial_text_en', 'filial_text_ru'

            ]);

            // Status ekle
            $data['status'] = 1;

            // Handle image uploads
            $imageFields = ['number_image', 'address_image', 'email_image'];
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $field . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/contact'), $fileName);
                    $data[$field] = 'uploads/contact/' . $fileName;
                }
            }

            // Debug için oluşturulacak veriyi görelim
            \Log::info('Contact create data:', $data);

            $contact = Contact::create($data);
            
            // Debug için oluşturulan kaydı görelim
            \Log::info('Created contact:', $contact->toArray());

            return redirect()->route('pages.contact.index')
                ->with('success', 'Əlaqə məlumatları uğurla əlavə edildi.');
        } catch (\Exception $e) {
            // Hata durumunda log'a yazalım
            \Log::error('Contact create error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('back.pages.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_az' => 'required|string|max:255',
            'number_az' => 'required|string|max:255',
            'address_az' => 'required|string|max:255',
            'email_az' => 'required|email|max:255',
            'name_en' => 'required|string|max:255',
            'number_en' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'email_en' => 'required|email|max:255',
            'name_ru' => 'required|string|max:255',
            'number_ru' => 'required|string|max:255',
            'address_ru' => 'required|string|max:255',
            'email_ru' => 'required|email|max:255',
            'number_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'address_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
           
            'filial_text_az' => 'nullable|string',
            'filial_text_en' => 'nullable|string',
            'filial_text_ru' => 'nullable|string',
        ]);

        try {
            $contact = Contact::findOrFail($id);
            $data = $request->only([
                'name_az', 'number_az', 'address_az', 'email_az',
                'name_en', 'number_en', 'address_en', 'email_en',
                'name_ru', 'number_ru', 'address_ru', 'email_ru',
                'filial_text_az', 'filial_text_en', 'filial_text_ru'
            ]);

            // Handle image uploads
            $imageFields = ['number_image', 'address_image', 'email_image'];
            foreach ($imageFields as $field) {
                if ($request->hasFile($field)) {
                    // Delete old image if exists
                    if ($contact->$field && File::exists(public_path($contact->$field))) {
                        File::delete(public_path($contact->$field));
                    }
                    
                    $file = $request->file($field);
                    $fileName = time() . '_' . $field . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/contact'), $fileName);
                    $data[$field] = 'uploads/contact/' . $fileName;
                }
            }

            // Debug için güncellenecek veriyi görelim
            \Log::info('Contact update data:', $data);

            $contact->update($data);
            
            // Debug için güncellenen kaydı görelim
            \Log::info('Updated contact:', $contact->fresh()->toArray());

            return redirect()->route('pages.contact.index')
                ->with('success', 'Əlaqə məlumatları uğurla yeniləndi.');
        } catch (\Exception $e) {
            // Hata durumunda log'a yazalım
            \Log::error('Contact update error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Xəta baş verdi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Delete associated images
        $imageFields = ['number_image', 'address_image', 'email_image'];
        foreach ($imageFields as $field) {
            if ($contact->$field && File::exists(public_path($contact->$field))) {
                File::delete(public_path($contact->$field));
            }
        }
        
        $contact->delete();

        return redirect()->route('pages.contact.index')
            ->with('success', 'Əlaqə məlumatları uğurla silindi.');
    }

    public function toggleStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = !$contact->status;
        $contact->save();

        return response()->json([
            'success' => true,
            'message' => 'Status uğurla dəyişdirildi.'
        ]);
    }
}