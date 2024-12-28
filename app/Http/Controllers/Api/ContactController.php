<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;


class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $contact = Contact::where('status', 1)->first();
            
            if (!$contact) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contact information not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contact information retrieved successfully',
                'data' => new ContactResource($contact)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching contact information',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}