<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $customers = Customer::where('status', 1)->get();
            return response()->json([
                'success' => true,
                'message' => 'Customers retrieved successfully',
                'data' => CustomerResource::collection($customers)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching customers',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $customer = Customer::where('status', 1)->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Customer retrieved successfully',
                'data' => new CustomerResource($customer)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found or an error occurred',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}