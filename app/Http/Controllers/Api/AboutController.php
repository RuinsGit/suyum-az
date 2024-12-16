<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $about = About::first();
            
            if (!$about) {
                return response()->json([
                    'success' => false,
                    'message' => 'About information not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'About information retrieved successfully',
                'data' => new AboutResource($about)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching about information',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}