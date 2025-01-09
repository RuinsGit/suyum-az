<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApplicationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:255',
                'message' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Doğrulama xətası',
                    'errors' => $validator->errors()
                ], 422);
            }

            $application = ProductApplication::create([
                'product_id' => $request->product_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'status' => false // varsayılan olarak gözləmədə
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Müraciətiniz uğurla qeydə alındı',
                'data' => $application
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 