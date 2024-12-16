<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HeaderResource;
use App\Models\Header;
use Illuminate\Http\JsonResponse;

class HeaderController extends Controller
{
    /**
     * Header verilerini getir
     */
    public function index(): JsonResponse
    {
        try {
            $header = Header::where('status', 1)->first();
            
            if (!$header) {
                return response()->json([
                    'success' => false,
                    'message' => 'Header not found',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Header retrieved successfully',
                'data' => new HeaderResource($header)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching header',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}