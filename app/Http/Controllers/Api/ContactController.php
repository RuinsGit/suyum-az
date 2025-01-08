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
            $contacts = Contact::where('status', 1)->get();
            
            if ($contacts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contact information not found',
                    'data' => []
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contact information retrieved successfully',
                'data' => ContactResource::collection($contacts)
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