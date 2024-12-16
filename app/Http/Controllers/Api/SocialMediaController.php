<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialMediaResource;
use App\Models\SocialMedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $socials = SocialMedia::where('status', 1)
                ->orderBy('order')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Social media links retrieved successfully',
                'data' => SocialMediaResource::collection($socials)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching social media links',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $social = SocialMedia::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Social media link retrieved successfully',
                'data' => new SocialMediaResource($social)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Social media link not found or an error occurred',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}