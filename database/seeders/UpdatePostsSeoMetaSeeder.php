<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdatePostsSeoMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Mevcut postlar için SEO meta verileri oluşturuluyor...');

        // Boş meta verili postları al
        $posts = DB::table('posts_optimized')
            ->whereNull('meta_title')
            ->orWhereNull('meta_description')
            ->orWhereNull('meta_keywords')
            ->select('id', 'title', 'content')
            ->get();

        $this->command->info("Güncellenecek post sayısı: " . $posts->count());

        $progressBar = $this->command->getOutput()->createProgressBar($posts->count());
        $progressBar->start();

        foreach ($posts as $post) {
            $seoData = $this->generateSeoMetaData($post->title, $post->content);

            DB::table('posts_optimized')
                ->where('id', $post->id)
                ->update([
                    'meta_title' => $seoData['meta_title'],
                    'meta_description' => $seoData['meta_description'],
                    'meta_keywords' => json_encode($seoData['meta_keywords']),
                    'updated_at' => now()
                ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('SEO meta verileri başarıyla güncellendi!');
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