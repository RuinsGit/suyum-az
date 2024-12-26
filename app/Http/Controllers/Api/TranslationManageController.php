<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationManagerResource;
use App\Models\TranslationManage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationManageController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $translations = TranslationManage::all();
            return response()->json([
                'success' => true,
                'message' => 'Translations retrieved successfully',
                'data' => TranslationManagerResource::collection($translations)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching translations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(TranslationManage $translationManage): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new TranslationManagerResource($translationManage)
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|unique:translation_manages,key',
            'value_az' => 'required',
            'value_en' => 'required',
            'value_ru' => 'required',
            'group' => 'required',
            'status' => 'required',
        ]);

        try {
            $translationManage = TranslationManage::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Translation created successfully',
                'data' => new TranslationManagerResource($translationManage)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating translation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, TranslationManage $translationManage): JsonResponse
    {
        $request->validate([
            'key' => 'required|unique:translation_manages,key,' . $translationManage->id,
            'value_az' => 'required',
            'value_en' => 'required',
            'value_ru' => 'required',
            'group' => 'required',
            'status' => 'required',
        ]);

        try {
            $translationManage->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Translation updated successfully',
                'data' => new TranslationManagerResource($translationManage)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating translation',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(TranslationManage $translationManage): JsonResponse
    {
        try {
            $translationManage->delete();
            return response()->json([
                'success' => true,
                'message' => 'Translation deleted successfully'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting translation',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

