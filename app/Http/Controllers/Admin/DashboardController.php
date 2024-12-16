<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Service;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Certificate;
use App\Models\ContactForm;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // İstatistikleri topla
            $statistics = [
                'total_products' => Product::count(),
                'active_products' => Product::where('status', true)->count(),
                'total_categories' => Category::count(),
                'active_categories' => Category::where('status', true)->count(),
                'total_services' => Service::count(),
                'active_services' => Service::where('status', true)->count(),
                'total_projects' => Project::count(),
                'active_projects' => Project::where('status', true)->count(),
                'total_customers' => Customer::count(),
                'active_customers' => Customer::where('status', true)->count(),
                'total_certificates' => Certificate::count(),
                'active_certificates' => Certificate::where('status', true)->count(),
                'unread_messages' => ContactForm::where('status', false)->count(),
                'total_messages' => ContactForm::count(),
            ];

            // Debug için
            \Log::info('Statistics:', $statistics);

            // Son eklenen ürünler
            $latest_products = Product::with('category')
                ->latest()
                ->take(5)
                ->get();
            
            // Son mesajlar
            $latest_messages = ContactForm::latest()
                ->take(5)
                ->get();

            return view('back.admin.dashboard', compact('statistics', 'latest_products', 'latest_messages'));

        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            
            // Hata durumunda boş değerlerle dön
            $statistics = [
                'total_products' => 0,
                'active_products' => 0,
                'total_categories' => 0,
                'active_categories' => 0,
                'total_services' => 0,
                'active_services' => 0,
                'total_projects' => 0,
                'active_projects' => 0,
                'total_customers' => 0,
                'active_customers' => 0,
                'total_certificates' => 0,
                'active_certificates' => 0,
                'unread_messages' => 0,
                'total_messages' => 0,
            ];

            $latest_products = collect([]);
            $latest_messages = collect([]);

            return view('back.admin.dashboard', compact('statistics', 'latest_products', 'latest_messages'));
        }
    }
}