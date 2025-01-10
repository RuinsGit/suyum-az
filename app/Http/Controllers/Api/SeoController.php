<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeoResource;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seos = Seo::where('status', true)->get();
        return SeoResource::collection($seos);
    }

    public function show($key)
    {
        $seo = Seo::where('key', $key)
                  ->where('status', true)
                  ->first();

        if (!$seo) {
            return response()->json([
                'message' => 'SEO məlumatı tapılmadı'
            ], 404);
        }

        return new SeoResource($seo);
    }
} 