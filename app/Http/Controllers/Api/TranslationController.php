<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationResource;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $translation = Translation::first();

            return response()->json([
                'success' => true,
                'message' => 'Translations retrieved successfully',
                'data' => new TranslationResource($translation)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching translations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $translation = Translation::first();
            if (!$translation) {
                $translation = new Translation();
            }

            // Logo işlemi
            if ($request->hasFile('logo')) {
                // Eski logo varsa sil
                if ($translation->logo && File::exists(public_path($translation->logo))) {
                    File::delete(public_path($translation->logo));
                }

                $logo = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('uploads/translations'), $logoName);
                $translation->logo = 'uploads/translations/' . $logoName;
            }

           

            $translation->save();

            return response()->json([
                'success' => true,
                'message' => 'Translations updated successfully',
                'data' => new TranslationResource($translation)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating translations',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}