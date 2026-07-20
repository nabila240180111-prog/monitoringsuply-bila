<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCache extends Model
{
    protected $table = 'news_caches';

    protected $fillable = [
        'country_code',
        'title',
        'description',
        'url',
        'source',
        'published_at',
        'sentiment_positive',
        'sentiment_negative',
        'sentiment_label',
    ];
}
