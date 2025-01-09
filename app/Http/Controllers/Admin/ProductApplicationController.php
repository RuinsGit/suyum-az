<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ProductApplicationController extends Controller
{
    public function index()
    {
        Artisan::call('migrate');
        $applications = ProductApplication::with('product')
            ->latest()
            ->paginate(10);

        return view('back.pages.product-applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = ProductApplication::with('product')->findOrFail($id);
        return view('back.pages.product-applications.show', compact('application'));
    }

    public function toggleStatus($id)
    {
        $application = ProductApplication::findOrFail($id);
        $application->status = !$application->status;
        $application->save();

        return redirect()->back()
            ->with('success', 'Müraciət statusu uğurla dəyişdirildi.');
    }

    public function destroy($id)
    {
        $application = ProductApplication::findOrFail($id);
        $application->delete();

        return redirect()->route('pages.product-applications.index')
            ->with('success', 'Müraciət uğurla silindi.');
    }
}