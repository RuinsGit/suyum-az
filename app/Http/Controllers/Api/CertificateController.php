<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificateResource;
use App\Models\Certificate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $certificates = Certificate::where('status', 1)->get();
            return response()->json([
                'success' => true,
                'message' => 'Certificates retrieved successfully',
                'data' => CertificateResource::collection($certificates)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching certificates',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $certificate = Certificate::where('status', 1)->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Certificate retrieved successfully',
                'data' => new CertificateResource($certificate)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found or an error occurred',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}