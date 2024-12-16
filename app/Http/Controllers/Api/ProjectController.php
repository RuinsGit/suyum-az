<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $projects = Project::where('status', 1)->get();
            return response()->json([
                'success' => true,
                'message' => 'Projects retrieved successfully',
                'data' => ProjectResource::collection($projects)
            ], 200);
            

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching projects',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $project = Project::where('status', 1)->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Project retrieved successfully',
                'data' => new ProjectResource($project)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found or an error occurred',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}