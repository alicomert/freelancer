<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('avatar')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('bio')->nullable();
            $table->string('title', 100)->nullable(); // Web Developer, Designer etc.
            $table->json('skills')->nullable(); // Kullanıcının yetenekleri
            $table->decimal('hourly_rate', 8, 2)->nullable(); // Saatlik ücret
            $table->string('location', 100)->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 20)->nullable(); // Telefon numarası
            $table->date('birth_date')->nullable(); // Doğum tarihi
            $table->string('tc_identity', 11)->nullable(); // TC Kimlik numarası
            $table->boolean('tc_verified')->default(false); // TC kimlik doğrulaması
            $table->boolean('is_freelancer')->default(false); // Freelancer mı?
            $table->boolean('is_company')->default(false); // Şirket mi?
            $table->string('company_name')->nullable(); // Şirket adı
            $table->string('company_tax_number')->nullable(); // Vergi numarası
            $table->text('company_address')->nullable(); // Şirket adresi
            $table->date('joined_date')->nullable(); // Katılma tarihi
            $table->integer('followers_count')->default(0); // Takipçi sayısı
            $table->integer('following_count')->default(0); // Takip edilen sayısı
            $table->integer('posts_count')->default(0); // Gönderi sayısı
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->decimal('total_earned', 12, 2)->default(0);
            $table->integer('completed_projects')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_seen')->nullable();
            $table->enum('status', ['active', 'suspended', 'banned'])->default('active');
            $table->rememberToken();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['status', 'is_verified']);
            $table->index(['rating', 'total_reviews']);
            $table->index('last_seen');
            $table->index('hourly_rate');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
