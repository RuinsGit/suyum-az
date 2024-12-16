<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactFormResource;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ContactFormController extends Controller
{
    /**
     * İletişim formu gönder
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'required|string'
            ]);

            $validated['status'] = false; // Yeni mesaj okunmamış olarak işaretlenir
            
            $contactForm = ContactForm::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => new ContactFormResource($contactForm)
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}