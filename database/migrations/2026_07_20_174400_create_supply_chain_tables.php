<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. risk_scores
        Schema::create('risk_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->double('weather_risk')->default(0);
            $table->double('inflation_risk')->default(0);
            $table->double('news_risk')->default(0);
            $table->double('currency_risk')->default(0);
            $table->double('total_risk')->default(0);
            $table->timestamps();
        });

        // 2. news_caches
        Schema::create('news_caches', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 3);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('source')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('sentiment_positive')->default(0);
            $table->integer('sentiment_negative')->default(0);
            $table->string('sentiment_label')->default('Neutral');
            $table->timestamps();
        });

        // 3. watchlists
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'country_id']);
        });

        // 4. articles (analysis articles)
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('author')->default('Admin');
            $table->timestamps();
        });

        // 5. positive_words
        Schema::create('positive_words', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique();
            $table->timestamps();
        });

        // 6. negative_words
        Schema::create('negative_words', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negative_words');
        Schema::dropIfExists('positive_words');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('watchlists');
        Schema::dropIfExists('news_caches');
        Schema::dropIfExists('risk_scores');
    }
};
