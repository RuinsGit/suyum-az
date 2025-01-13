<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::first();
        
        if (!$logo) {
            return response()->json([
                'status' => false,
                'message' => 'Logo tapılmadı'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $logo->id,
                'logo' => $logo->logo ? asset($logo->logo) : null,
                'favicon' => $logo->favicon ? asset($logo->favicon) : null,
                'status' => (bool)$logo->status,
                'created_at' => $logo->created_at,
                'updated_at' => $logo->updated_at
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
        ]);

        $logo = Logo::first();
        if (!$logo) {
            $logo = new Logo();
            $logo->status = true;
        } else {
            $logo->status = $request->has('status') ? 1 : 0;
        }

        if ($request->hasFile('logo')) {
            if ($logo->logo && File::exists(public_path($logo->logo))) {
                File::delete(public_path($logo->logo));
            }
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('uploads/logo'), $logoName);
            $logo->logo = 'uploads/logo/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            if ($logo->favicon && File::exists(public_path($logo->favicon))) {
                File::delete(public_path($logo->favicon));
            }
            $faviconFile = $request->file('favicon');
            $faviconName = 'favicon_' . time() . '.' . $faviconFile->getClientOriginalExtension();
            $faviconFile->move(public_path('uploads/logo'), $faviconName);
            $logo->favicon = 'uploads/logo/' . $faviconName;
        }

        $logo->save();

        return response()->json([
            'status' => true,
            'message' => 'Logo uğurla yeniləndi',
            'data' => [
                'id' => $logo->id,
                'logo' => $logo->logo ? asset($logo->logo) : null,
                'favicon' => $logo->favicon ? asset($logo->favicon) : null,
                'status' => (bool)$logo->status,
                'created_at' => $logo->created_at,
                'updated_at' => $logo->updated_at
            ]
        ]);
    }
} 