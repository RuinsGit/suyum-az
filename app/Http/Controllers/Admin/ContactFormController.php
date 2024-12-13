<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index()
    {
        $messages = ContactForm::latest()->paginate(10);
        return view('back.pages.contact-form.index', compact('messages'));
    }

    public function show(ContactForm $contactForm)
    {
        // Mesaj görüntülendiğinde okundu olarak işaretle
        if (!$contactForm->status) {
            $contactForm->update(['status' => true]);
        }
        return view('back.pages.contact-form.show', compact('contactForm'));
    }

    public function destroy(ContactForm $contactForm)
    {
        $contactForm->delete();
        return redirect()->route('pages.contact-form.index')
            ->with('success', 'Mesaj uğurla silindi.');
    }

    public function markAsRead(ContactForm $contactForm)
    {
        $contactForm->update(['status' => true]);
        return redirect()->back()->with('success', 'Mesaj oxunmuş kimi qeyd edildi.');
    }

    public function markAsUnread(ContactForm $contactForm)
    {
        $contactForm->update(['status' => false]);
        return redirect()->back()->with('success', 'Mesaj oxunmamış kimi qeyd edildi.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        ContactForm::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Seçilmiş mesajlar silindi."]);
    }
}