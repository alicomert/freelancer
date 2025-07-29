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
     * Gönderi ekleme sayfasını göster
     */
    public function create()
    {
        // Normal post ve anket için post kategorileri
        $postCategories = Category::where('is_active', true)
            ->where('category_type', 'post')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            
        // Hizmet ilanı ve açık artırma için servis kategorileri
        $serviceCategories = Category::where('is_active', true)
            ->where('category_type', 'service')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Portfolyo ve freelance proje için proje kategorileri
        $projectCategories = Category::where('is_active', true)
            ->where('category_type', 'project')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        return view('posts.create', compact('postCategories', 'serviceCategories', 'projectCategories'));
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
                    'poll_question' => 'required|string|max:500',
                    'poll_options' => 'required|array|min:2',
                    'poll_options.*' => 'required|string|max:255',
                    'poll_type' => 'nullable|in:single,multiple',
                    'poll_expires_at' => 'nullable|date|after:now',
                    'poll_anonymous' => 'nullable|boolean',
                ]);
                break;
                
            case 5: // Portfolyo
                $rules = array_merge($rules, [
                    'portfolio_project_title' => 'required|string|max:255',
                    'portfolio_project_description' => 'required|string',
                    'portfolio_project_url' => 'nullable|url',
                    'portfolio_technologies' => 'nullable|string',
                    'portfolio_completion_date' => 'nullable|date|before_or_equal:today',
                ]);
                break;
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            // Ana post kaydı
            $postId = DB::table('posts_optimized')->insertGetId([
                'uuid' => Str::uuid(),
                'user_id' => Auth::id(),
                'post_type' => $request->post_type,
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . Str::random(6),
                'content' => $request->content,
                'excerpt' => Str::limit(strip_tags($request->content), 200),
                'category_id' => $request->category_id,
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
                case 5: // Portfolyo
                    $this->storePortfolioData($postId, $request);
                    break;
                case 6: // Freelance proje
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
        // Hizmet öğelerini doğrudan post_services tablosuna kaydet
        if ($request->service_items && is_array($request->service_items)) {
            $totalItems = 0;
            foreach ($request->service_items as $index => $item) {
                // Sadece başlığı olan hizmet öğelerini kaydet
                if (!empty(trim($item['title']))) {
                    DB::table('post_services')->insert([
                        'post_id' => $postId,
                        'title' => $item['title'],
                        'description' => $item['description'] ?? null,
                        'price' => $item['price'] ?? 0,
                        'discount_price' => !empty($item['discount_price']) ? $item['discount_price'] : null,
                        'sale_type' => $item['sale_type'] ?? 'internal',
                        'external_url' => ($item['sale_type'] === 'external' && !empty($item['external_url'])) ? $item['external_url'] : null,
                        'delivery_time' => $item['delivery_time'] ?? null,
                        'delivery_time_unit' => $item['delivery_time_unit'] ?? 'day',
                        'auto_delivery' => isset($item['auto_delivery']) && $item['auto_delivery'] == '1' ? true : false,
                        'features' => !empty($item['features']) ? $item['features'] : null, // Zaten JSON string olarak geliyor
                        'is_active' => true,
                        'sort_order' => $index + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $totalItems++;
                }
            }

            // Meta data'yı güncelle
            $metaData = [
                'service_type' => 'multi_item',
                'total_items' => $totalItems,
            ];

            DB::table('posts_optimized')
                ->where('id', $postId)
                ->update(['meta_data' => json_encode($metaData)]);
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
    }

    /**
     * Anket verilerini kaydet
     */
    private function storePollData($postId, $request)
    {
        // Ana anket kaydı
        $pollId = DB::table('post_polls')->insertGetId([
            'post_id' => $postId,
            'question' => $request->poll_question,
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
                }
            }
        }
    }

    /**
     * Portfolyo verilerini kaydet
     */
    private function storePortfolioData($postId, $request)
    {
        DB::table('post_portfolios')->insert([
            'post_id' => $postId,
            'project_title' => $request->portfolio_project_title,
            'project_description' => $request->portfolio_project_description,
            'project_url' => $request->portfolio_project_url,
            'technologies_used' => $request->portfolio_technologies,
            'completion_date' => $request->portfolio_completion_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Freelance proje verilerini kaydet
     */
    private function storeProjectData($postId, $request)
    {
        // Bu metod gelecekte genişletilebilir
        // Şu an için sadece temel post verisi yeterli
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
}