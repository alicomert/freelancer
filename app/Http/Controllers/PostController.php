<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Tüm gönderileri listele
     */
    public function index(Request $request)
    {
        $query = \App\Models\PostOptimized::with(['user', 'category', 'tags'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc');

        // Filtreleme
        if ($request->filled('type')) {
            $query->where('post_type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sıralama
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'popular':
                    $query->orderBy('views_count', 'desc');
                    break;
                case 'trending':
                    $query->where('created_at', '>=', now()->subDays(7))
                          ->orderBy('views_count', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // AJAX isteği için JSON döndür
        if ($request->ajax()) {
            $posts = $query->paginate(9);
            return response()->json([
                'posts' => $posts->items(),
                'has_more' => $posts->hasMorePages(),
                'next_page' => $posts->currentPage() + 1
            ]);
        }

        return view('posts.index');
    }

    /**
     * Gönderi ekleme sayfasını göster
     */
    public function create()
    {
        // Normal post ve anket için community kategorileri
        $postCategories = Category::where('is_active', true)
            ->where('type', 'community')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            
        // Hizmet ilanı ve açık artırma için servis kategorileri
        $serviceCategories = Category::where('is_active', true)
            ->where('type', 'service')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Portfolyo ve freelance proje için portfolyo kategorileri
        $projectCategories = Category::where('is_active', true)
            ->where('type', 'project')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create', compact('postCategories', 'serviceCategories', 'projectCategories'));
    }

    /**
     * Normal post oluşturma sayfasını göster
     */
    public function createPost()
    {
        $postCategories = Category::where('is_active', true)
            ->where('type', 'community')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.post', compact('postCategories'));
    }

    /**
     * Hizmet ilanı oluşturma sayfasını göster
     */
    public function createService()
    {
        $serviceCategories = Category::where('is_active', true)
            ->where('type', 'service')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.service', compact('serviceCategories'));
    }

    /**
     * Açık artırma oluşturma sayfasını göster
     */
    public function createAuction()
    {
        $serviceCategories = Category::where('is_active', true)
            ->where('type', 'service')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.auction', compact('serviceCategories'));
    }

    /**
     * Anket oluşturma sayfasını göster
     */
    public function createPoll()
    {
        $postCategories = Category::where('is_active', true)
            ->where('type', 'community')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.poll', compact('postCategories'));
    }

    /**
     * Portfolyo oluşturma sayfasını göster
     */
    public function createPortfolio()
    {
        $projectCategories = Category::where('is_active', true)
            ->where('type', 'portfolio')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.portfolio', compact('projectCategories'));
    }

    /**
     * Freelance proje oluşturma sayfasını göster
     */
    public function createFreelance()
    {
        $projectCategories = Category::where('is_active', true)
            ->where('type', 'project')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create.freelance', compact('projectCategories'));
    }

    /**
     * Yeni gönderi kaydet
     */
    public function store(Request $request)
    {
        // Debug için request verilerini logla
        \Log::info('Post store request:', $request->all());

        // Temel validation kuralları
        $rules = [
            'post_type' => 'required|integer|in:1,2,3,4,5,6',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
        ];

        // Post tipine göre ek validation kuralları
        switch ($request->post_type) {
            case 2: // Hizmet ilanı
                $rules = array_merge($rules, [
                    'service_auto_delivery' => 'nullable|boolean',
                    'service_items' => 'nullable|array',
                    'service_items.*.title' => 'required|string|max:255',
                    'service_items.*.description' => 'nullable|string',
                    'service_items.*.price' => 'required|numeric|min:0',
                    'service_items.*.discount_price' => 'nullable|numeric|min:0',
                    'service_items.*.delivery_time' => 'nullable|numeric|min:0',
                    'service_items.*.delivery_time_unit' => 'nullable|in:instant,hour,day,week,month',
                    'service_items.*.sale_type' => 'required|in:internal,external',
                    'service_items.*.external_url' => 'required_if:service_items.*.sale_type,external|nullable|url',
                ]);
                break;
                
            case 3: // Açık artırma
                $rules = array_merge($rules, [
                    'auction_starting_price' => 'required|numeric|min:0',
                    'auction_reserve_price' => 'nullable|numeric|min:0',
                    'auction_end_time' => 'required|date|after:now',
                    'auction_auto_extend' => 'nullable|boolean',
                ]);
                break;
                
            case 4: // Anket
                $rules = array_merge($rules, [
                    'title' => 'required|string|max:255', // poll_question yerine title
                    'category_id' => 'required|exists:categories,id',
                    'poll_options' => 'required|array|min:2',
                    'poll_options.*' => 'required|string|max:255',
                    'poll_type' => 'nullable|in:single,multiple',
                    'poll_expires_at' => 'nullable|date|after:now',
                    'poll_anonymous' => 'nullable|boolean',
                ]);
                // Content zorunlu değil, kaldırıyoruz
                unset($rules['content']);
                break;
                
            case 5: // Alıcı İsteği (Buyer Request)
                $rules = array_merge($rules, [
                    'buyer_request_job_type' => 'required|in:time_based,project_based',
                    'buyer_request_budget_min' => 'nullable|numeric|min:0',
                    'buyer_request_budget_max' => 'nullable|numeric|min:0|gte:buyer_request_budget_min',
                    'buyer_request_currency' => 'required|string|size:3',
                    'buyer_request_work_duration_type' => 'required_if:buyer_request_job_type,time_based|in:hourly,daily',
                    'buyer_request_delivery_time' => 'required_if:buyer_request_job_type,project_based|in:few_days,one_week,one_month,one_to_three_months,more_than_three_months',
                    'buyer_request_experience_level' => 'nullable|in:beginner,intermediate,expert',
                    'buyer_request_location' => 'nullable|string|max:255',
                    'buyer_request_deadline' => 'nullable|date|after:now',
                ]);
                break;
                
            case 6: // Portfolyo
                $rules = array_merge($rules, [
                    'project_type' => 'required|in:web,mobile,desktop,design,other',
                    'portfolio_project_url' => 'nullable|url',
                    'portfolio_technologies' => 'nullable|string',
                    'portfolio_completion_date' => 'nullable|date|before_or_equal:today',
                ]);
                break;
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // Post tipine göre kategori ID, başlık ve içerik belirle
            $categoryId = $request->category_id;
            $title = $request->title;
            $content = $request->content ?? '';
            
            if ($request->post_type == 4) { // Anket
                $content = ''; // Anket için içerik boş
            }

            // SEO meta verilerini oluştur
            $seoData = $this->generateSeoMetaData($title, $content, $request->tags);

            // Ana post kaydı
            $postId = DB::table('posts_optimized')->insertGetId([
                'uuid' => Str::uuid(),
                'user_id' => Auth::id(),
                'post_type' => $request->post_type,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(6),
                'content' => $content,
                'excerpt' => Str::limit(strip_tags($content), 200),
                'category_id' => $categoryId,
                'meta_title' => $seoData['meta_title'],
                'meta_description' => $seoData['meta_description'],
                'meta_keywords' => json_encode($seoData['meta_keywords']),
                'status' => 1, // Yayında
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            \Log::info('Post created with ID: ' . $postId);

            // Post tipine göre ek veriler
            switch ($request->post_type) {
                case 2: // Hizmet ilanı
                    $this->storeServiceData($postId, $request);
                    break;
                case 3: // Açık artırma
                    $this->storeAuctionData($postId, $request);
                    break;
                case 4: // Anket
                    $this->storePollData($postId, $request);
                    break;
                case 5: // Alıcı İsteği (Buyer Request)
                    $this->storeBuyerRequestData($postId, $request);
                    break;
                case 6: // Portfolyo
                    $this->storePortfolioData($postId, $request);
                    break;
                case 7: // Freelance proje
                    $this->storeProjectData($postId, $request);
                    break;
            }

            // Etiketleri kaydet
            if ($request->tags) {
                $this->storeTags($postId, $request->tags);
            }

            DB::commit();
            \Log::info('Post transaction committed successfully');

            return redirect()->route('posts.show', $postId)
                ->with('success', 'Gönderi başarıyla oluşturuldu!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Post creation failed: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->withInput()
                ->with('error', 'Gönderi oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Hizmet verilerini kaydet
     */
    private function storeServiceData($postId, $request)
    {
        // Kategori adını al
        $categoryName = 'Genel';
        if ($request->category_id) {
            $category = DB::table('categories')->where('id', $request->category_id)->first();
            if ($category) {
                $categoryName = $category->name;
            }
        }
        
        // Hizmet öğelerini doğrudan post_services tablosuna kaydet
        if ($request->service_items && is_array($request->service_items)) {
            $totalItems = 0;
            $minPrice = null;
            $maxPrice = null;
            $deliveryOptions = [];
            $hasDiscount = false;
            $hasExternalSales = false;
            $totalFeatures = 0;
            $hasAutoDelivery = false;
            foreach ($request->service_items as $index => $item) {
                // Sadece fiyatı olan hizmet öğelerini kaydet
                if (!empty($item['price']) && is_numeric($item['price']) && $item['price'] > 0) {
                    $price = (float)$item['price'];
                    
                    // Fiyat aralığını hesapla
                    if ($minPrice === null || $price < $minPrice) $minPrice = $price;
                    if ($maxPrice === null || $price > $maxPrice) $maxPrice = $price;
                    
                    // İndirim kontrolü
                    if (!empty($item['discount_price'])) $hasDiscount = true;
                    
                    // Satış tipi kontrolü
                    if (!empty($item['sale_type']) && $item['sale_type'] === 'external') $hasExternalSales = true;
                    
                    // Otomatik teslimat kontrolü
                    if (!empty($item['auto_delivery'])) $hasAutoDelivery = true;
                    // Teslimat süresini birim bazında hesapla (gün cinsinden)
                    $deliveryTimeInDays = 1; // Varsayılan 1 gün
                    if (!empty($item['delivery_time']) && is_numeric($item['delivery_time'])) {
                        $timeValue = (int)$item['delivery_time'];
                        $unit = $item['delivery_time_unit'] ?? 'day';
                        
                        switch ($unit) {
                            case 'instant':
                                $deliveryTimeInDays = 0;
                                $deliveryOptions[] = 'Anında';
                                break;
                            case 'hour':
                                $deliveryTimeInDays = max(1, ceil($timeValue / 24));
                                $deliveryOptions[] = $timeValue . ' Saat';
                                break;
                            case 'day':
                                $deliveryTimeInDays = $timeValue;
                                $deliveryOptions[] = $timeValue . ' Gün';
                                break;
                            case 'week':
                                $deliveryTimeInDays = $timeValue * 7;
                                $deliveryOptions[] = $timeValue . ' Hafta';
                                break;
                            case 'month':
                                $deliveryTimeInDays = $timeValue * 30;
                                $deliveryOptions[] = $timeValue . ' Ay';
                                break;
                            default:
                                $deliveryTimeInDays = $timeValue;
                                $deliveryOptions[] = $timeValue . ' Gün';
                        }
                    }

                    // Features'ı JSON array'e çevir
                    $features = [];
                    if (!empty($item['features'])) {
                        if (is_string($item['features'])) {
                            $features = json_decode($item['features'], true) ?: [];
                        } else if (is_array($item['features'])) {
                            $features = $item['features'];
                        }
                        $totalFeatures += count($features);
                    }

                    DB::table('post_services')->insert([
                        'post_id' => $postId,
                        'price' => $item['price'] ?? 0,
                        'delivery_time' => $deliveryTimeInDays,
                        'revision_count' => 1,
                        'features' => !empty($features) ? json_encode($features) : null,
                        'requirements' => null,
                        'gallery' => null,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $totalItems++;
                }
            }

            // Meta veriler - hizmet detayları
            $metaData = [
                'original_type' => 'service',
                'service_count' => $totalItems,
                'price_range' => [
                    'min' => $minPrice,
                    'max' => $maxPrice
                ],
                'delivery_options' => array_unique($deliveryOptions),
                'has_discount' => $hasDiscount,
                'has_external_sales' => $hasExternalSales,
                'features_count' => $totalFeatures,
                'auto_delivery_available' => $hasAutoDelivery
            ];
            
            // Service item sayısını excerpt alanında saklayabiliriz
            $excerpt = "Bu hizmet {$categoryName} alanında {$totalItems} farklı paket içermektedir.";
            
            DB::table('posts_optimized')
                ->where('id', $postId)
                ->update([
                    'excerpt' => $excerpt,
                    'meta_data' => json_encode($metaData)
                ]);
        }
    }

    /**
     * Açık artırma verilerini kaydet
     */
    private function storeAuctionData($postId, $request)
    {
        DB::table('post_auctions')->insert([
            'post_id' => $postId,
            'starting_price' => $request->auction_starting_price,
            'reserve_price' => $request->auction_reserve_price,
            'current_price' => $request->auction_starting_price,
            'end_time' => $request->auction_end_time,
            'auto_extend' => $request->auction_auto_extend ?? false,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Meta veriler
        $metaData = [
            'original_type' => 'auction',
            'starting_price' => $request->auction_starting_price,
            'reserve_price' => $request->auction_reserve_price,
            'has_reserve_price' => !empty($request->auction_reserve_price),
            'auto_extend' => $request->auction_auto_extend ?? false,
            'end_time' => $request->auction_end_time,
            'duration_hours' => $request->auction_end_time ? 
                round((strtotime($request->auction_end_time) - time()) / 3600, 2) : null
        ];

        $excerpt = "Açık artırma - Başlangıç fiyatı: " . number_format($request->auction_starting_price, 2) . " TL";
        
        DB::table('posts_optimized')
            ->where('id', $postId)
            ->update([
                'excerpt' => $excerpt,
                'meta_data' => json_encode($metaData)
            ]);
    }

    /**
     * Anket verilerini kaydet
     */
    private function storePollData($postId, $request)
    {
        // Anket verilerini kaydet
        $pollId = DB::table('post_polls')->insertGetId([
            'post_id' => $postId,
            'question' => $request->title, // title kullanıyoruz
            'multiple_choice' => $request->poll_type === 'multiple',
            'anonymous_voting' => $request->poll_anonymous ?? true,
            'end_date' => $request->poll_expires_at,
            'show_results' => true,
            'allow_add_options' => false,
            'total_votes' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Anket seçenekleri
        $optionsCount = 0;
        if ($request->poll_options) {
            foreach ($request->poll_options as $index => $option) {
                if (!empty(trim($option))) {
                    DB::table('poll_options')->insert([
                        'poll_id' => $pollId,
                        'option_text' => trim($option),
                        'vote_count' => 0,
                        'order_index' => $index,
                        'created_by_user_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $optionsCount++;
                }
            }
        }

        // Meta veriler
        $metaData = [
            'original_type' => 'poll',
            'poll_type' => $request->poll_type,
            'options_count' => $optionsCount,
            'is_multiple_choice' => $request->poll_type === 'multiple',
            'is_anonymous' => $request->poll_anonymous ?? true,
            'has_end_date' => !empty($request->poll_expires_at),
            'end_date' => $request->poll_expires_at
        ];

        $excerpt = ($request->poll_type === 'multiple' ? 'Çoklu seçim' : 'Tek seçim') . " anketi - {$optionsCount} seçenek.";
        
        DB::table('posts_optimized')
            ->where('id', $postId)
            ->update([
                'excerpt' => $excerpt,
                'meta_data' => json_encode($metaData)
            ]);
    }

    /**
     * Portfolyo verilerini kaydet
     */
    private function storePortfolioData($postId, $request)
    {
        // Teknolojileri JSON formatına çevir
        $technologies = [];
        if ($request->portfolio_technologies) {
            $technologies = array_map('trim', explode(',', $request->portfolio_technologies));
            $technologies = array_filter($technologies);
        }

        DB::table('post_portfolios')->insert([
            'post_id' => $postId,
            'project_type' => $request->project_type,
            'project_url' => $request->portfolio_project_url,
            'technologies_used' => json_encode($technologies),
            'completion_date' => $request->portfolio_completion_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Meta veriler
        $metaData = [
            'original_type' => 'portfolio',
            'project_type' => $request->project_type,
            'technologies_count' => count($technologies),
            'technologies' => $technologies,
            'has_project_url' => !empty($request->portfolio_project_url),
            'has_completion_date' => !empty($request->portfolio_completion_date),
            'completion_year' => $request->portfolio_completion_date ? date('Y', strtotime($request->portfolio_completion_date)) : null
        ];

        $projectTypeText = [
            'web' => 'Web',
            'mobile' => 'Mobil',
            'desktop' => 'Masaüstü',
            'design' => 'Tasarım',
            'other' => 'Diğer'
        ];
        
        $typeText = $projectTypeText[$request->project_type] ?? 'Portfolyo';
        $excerpt = "{$typeText} projesi - " . count($technologies) . " teknoloji kullanılmış.";
        
        DB::table('posts_optimized')
            ->where('id', $postId)
            ->update([
                'excerpt' => $excerpt,
                'meta_data' => json_encode($metaData)
            ]);
    }

    /**
     * Alıcı isteği verilerini kaydet
     */
    private function storeBuyerRequestData($postId, $request)
    {
        // Gerekli becerileri JSON formatına çevir
        $requiredSkills = [];
        if ($request->has('buyer_request_skills')) {
            $skills = is_string($request->buyer_request_skills) 
                ? array_map('trim', explode(',', $request->buyer_request_skills))
                : $request->buyer_request_skills;
            $requiredSkills = array_filter($skills);
        }

        // Meta veriler
        $metaData = [
            'original_type' => 'buyer_request',
            'job_type' => $request->buyer_request_job_type,
            'skills' => $requiredSkills,
        ];

        DB::table('post_buyer_requests')->insert([
            'post_id' => $postId,
            'job_type' => $request->buyer_request_job_type,
            'work_duration_type' => $request->buyer_request_job_type === 'time_based' 
                ? $request->buyer_request_work_duration_type 
                : null,
            'delivery_time' => $request->buyer_request_job_type === 'project_based' 
                ? $request->buyer_request_delivery_time 
                : null,
            'budget_min' => $request->buyer_request_budget_min ?? null,
            'budget_max' => $request->buyer_request_budget_max ?? null,
            'currency' => $request->buyer_request_currency ?? 'TRY',
            'required_skills' => json_encode($requiredSkills),
            'experience_level' => $request->buyer_request_experience_level ?? null,
            'location' => $request->buyer_request_location ?? null,
            'meta_data' => json_encode($metaData),
            'status' => 1, // Aktif
            'deadline' => $request->buyer_request_deadline ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buyer request bilgilerini excerpt alanında saklayabiliriz
        $jobTypeText = $request->buyer_request_job_type === 'time_based' ? 'Saatlik' : 'Proje bazlı';
        $excerpt = "{$jobTypeText} iş ilanı - " . count($requiredSkills) . " beceri gerektiriyor.";
        
        // Posts_optimized tablosuna da meta_data ekle
        $postsMetaData = [
            'original_type' => 'buyer_request',
            'job_type' => $request->buyer_request_job_type,
            'skills_count' => count($requiredSkills),
            'budget_range' => [
                'min' => $request->buyer_request_budget_min,
                'max' => $request->buyer_request_budget_max,
                'currency' => $request->buyer_request_currency ?? 'TRY'
            ],
            'experience_level' => $request->buyer_request_experience_level,
            'location' => $request->buyer_request_location,
            'has_deadline' => !empty($request->buyer_request_deadline)
        ];
        
        DB::table('posts_optimized')
            ->where('id', $postId)
            ->update([
                'excerpt' => $excerpt,
                'meta_data' => json_encode($postsMetaData)
            ]);
    }

    /**
     * Freelance proje verilerini kaydet
     */
    private function storeProjectData($postId, $request)
    {
        // Bu metod gelecekte genişletilebilir
        // Şu an için sadece temel post verisi yeterli
        
        // Meta veriler
        $metaData = [
            'original_type' => 'project',
            'created_at' => now()->toISOString()
        ];

        $excerpt = "Freelance proje ilanı";
        
        DB::table('posts_optimized')
            ->where('id', $postId)
            ->update([
                'excerpt' => $excerpt,
                'meta_data' => json_encode($metaData)
            ]);
    }

    /**
     * Etiketleri kaydet
     */
    private function storeTags($postId, $tagsString)
    {
        $tags = array_map('trim', explode(',', $tagsString));
        
        foreach ($tags as $tagName) {
            if (empty($tagName)) continue;
            
            // Etiket var mı kontrol et, yoksa oluştur
            $tagId = DB::table('tags')->where('name', $tagName)->value('id');
            
            if (!$tagId) {
                $tagId = DB::table('tags')->insertGetId([
                    'name' => $tagName,
                    'slug' => Str::slug($tagName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
            // Post-etiket ilişkisi
            DB::table('post_tags')->insert([
                'post_id' => $postId,
                'tag_id' => $tagId,
                'created_at' => now(),
            ]);
        }
    }

    /**
     * Gönderi detayını göster
     */
    public function show($id)
    {
        $post = \App\Models\PostOptimized::with(['user', 'category'])
            ->where('id', $id)
            ->where('status', 1)
            ->first();

        if (!$post) {
            abort(404);
        }

        // Görüntülenme sayısını artır
        $post->increment('views_count');

        return view('posts.show', compact('post'));
    }

    /**
     * SEO meta verilerini otomatik oluştur
     */
    private function generateSeoMetaData($title, $content, $tags = null)
    {
        // İçeriği temizle
        $cleanContent = strip_tags($content);
        $cleanContent = preg_replace('/\s+/', ' ', $cleanContent);
        $cleanContent = trim($cleanContent);

        // Meta title oluştur (55-60 karakter arası)
        $metaTitle = $title;
        if (strlen($metaTitle) > 55) {
            $metaTitle = substr($metaTitle, 0, 52) . '...';
        }

        // Meta description oluştur (150-160 karakter arası)
        $metaDescription = $cleanContent;
        if (strlen($metaDescription) > 155) {
            // Cümle sonunda kes
            $metaDescription = substr($metaDescription, 0, 152);
            $lastSpace = strrpos($metaDescription, ' ');
            if ($lastSpace !== false) {
                $metaDescription = substr($metaDescription, 0, $lastSpace);
            }
            $metaDescription .= '...';
        }

        // Meta keywords oluştur
        $metaKeywords = [];
        
        // Etiketlerden keywords al
        if ($tags && is_string($tags)) {
            $tagArray = array_map('trim', explode(',', $tags));
            $metaKeywords = array_merge($metaKeywords, $tagArray);
        } elseif ($tags && is_array($tags)) {
            $metaKeywords = array_merge($metaKeywords, $tags);
        }

        // İçerikten önemli kelimeleri çıkar
        $contentKeywords = $this->extractKeywordsFromContent($cleanContent, $title);
        $metaKeywords = array_merge($metaKeywords, $contentKeywords);

        // Tekrarları temizle ve sınırla (max 10 keyword)
        $metaKeywords = array_unique(array_filter($metaKeywords));
        $metaKeywords = array_slice($metaKeywords, 0, 10);

        return [
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $metaKeywords
        ];
    }

    /**
     * İçerikten anahtar kelimeleri çıkar
     */
    private function extractKeywordsFromContent($content, $title)
    {
        $keywords = [];
        
        // Başlıktan kelimeleri al
        $titleWords = explode(' ', strtolower($title));
        $titleWords = array_filter($titleWords, function($word) {
            return strlen($word) > 3; // 3 karakterden uzun kelimeler
        });
        $keywords = array_merge($keywords, $titleWords);

        // İçerikten sık geçen kelimeleri bul
        $words = str_word_count(strtolower($content), 1, 'çğıöşüÇĞIİÖŞÜ');
        $wordCounts = array_count_values($words);
        
        // Stopwords (gereksiz kelimeler) listesi
        $stopwords = ['bir', 'bu', 'şu', 'o', 've', 'ile', 'için', 'olan', 'olarak', 'gibi', 'kadar', 'daha', 'en', 'çok', 'az', 'var', 'yok', 'da', 'de', 'ta', 'te', 'ki', 'mi', 'mı', 'mu', 'mü', 'the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should'];
        
        // Stopwords'leri filtrele ve sık geçen kelimeleri al
        $filteredWords = array_filter($wordCounts, function($count, $word) use ($stopwords) {
            return $count >= 2 && strlen($word) > 3 && !in_array($word, $stopwords);
        }, ARRAY_FILTER_USE_BOTH);
        
        // En sık geçen 5 kelimeyi al
        arsort($filteredWords);
        $topWords = array_slice(array_keys($filteredWords), 0, 5);
        $keywords = array_merge($keywords, $topWords);

        return array_unique($keywords);
    }
}