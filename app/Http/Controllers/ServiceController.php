<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        // Hizmet kategorilerini getir (sadece service tipindeki aktif kategoriler)
        $serviceCategories = Category::services()
            ->active()
            ->orderBy('sort_order')
            ->get();

        // Öne çıkan hizmetleri getir
        $featuredServices = Service::with(['user', 'category'])
            ->active()
            ->featured()
            ->orderBy('rating', 'desc')
            ->limit(5)
            ->get();

        // Tüm aktif hizmetleri getir (sayfalama için)
        $services = Service::with(['user', 'category'])
            ->active()
            ->orderBy('is_featured', 'desc')
            ->orderBy('rating', 'desc')
            ->paginate(10);

        // Öne çıkan satıcıları getir (en çok satış yapan kullanıcılar)
        $topSellers = Service::with('user')
            ->selectRaw('user_id, SUM(sales_count) as total_sales, AVG(rating) as avg_rating, COUNT(*) as service_count')
            ->active()
            ->groupBy('user_id')
            ->orderBy('total_sales', 'desc')
            ->limit(4)
            ->get();

        return view('services.index', compact('serviceCategories', 'featuredServices', 'services', 'topSellers'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('category_type', 'service')
            ->firstOrFail();

        $services = Service::with(['user', 'category'])
            ->active()
            ->byCategory($category->id)
            ->orderBy('is_featured', 'desc')
            ->orderBy('rating', 'desc')
            ->paginate(12);

        return view('services.category', compact('category', 'services'));
    }

    public function show($id)
    {
        $service = Service::with(['user', 'category'])
            ->active()
            ->findOrFail($id);

        // İlgili hizmetleri getir (aynı kategoriden)
        $relatedServices = Service::with(['user', 'category'])
            ->active()
            ->byCategory($service->category_id)
            ->where('id', '!=', $service->id)
            ->orderBy('rating', 'desc')
            ->limit(4)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
