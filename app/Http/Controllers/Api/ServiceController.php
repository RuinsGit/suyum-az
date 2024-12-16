<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $services = Service::where('status', 1)
                ->latest()
                ->paginate($request->per_page ?? 10);

            return response()->json([
                'success' => true,
                'message' => 'Services retrieved successfully',
                'data' => ServiceResource::collection($services),
                'meta' => [
                    'current_page' => $services->currentPage(),
                    'last_page' => $services->lastPage(),
                    'per_page' => $services->perPage(),
                    'total' => $services->total()
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching services',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $service = Service::where('status', 1)->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Service retrieved successfully',
                'data' => new ServiceResource($service)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found or an error occurred',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}