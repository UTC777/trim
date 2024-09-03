<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\StaticSeo;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Post extends Model implements HasMedia, Viewable
{
    use SoftDeletes, InteractsWithMedia, HasFactory, InteractsWithViews;

    public $table = 'posts';

    protected $appends = [
        'featured_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'published',
        'title',
        'page_text',
        'excerpt',
        'slug',
        'author_id',
        'word_count',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function booted()
    {
        static::saved(function ($post) {
            Cache::forget("post_{$post->id}");
        });

        static::deleted(function ($post) {
            Cache::forget("post_{$post->id}");
        });
    }

    public static function getCached($id)
    {
        return Cache::remember("post_{$id}", now()->addWeek(), function () use ($id) {
            return static::with(['categories', 'tags', 'author', 'staticSeo'])->findOrFail($id);
        });
    }

    public function updateWordCount()
    {
        $this->word_count = str_word_count(strip_tags($this->page_text));
        $this->save();
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->word_count = str_word_count(strip_tags($post->page_text));
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('thumb')->format(Manipulations::FORMAT_WEBP)->width(150)->height(150)->nonQueued();
        $this->addMediaConversion('preview')->format(Manipulations::FORMAT_WEBP)->width(120)->height(120)->nonQueued();
        $this->addMediaConversion('responsive')->format(Manipulations::FORMAT_WEBP)->width(1200)->height(500)->withResponsiveImages()->nonQueued();
        $this->addMediaConversion('featured')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 820, 500)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
        $this->addMediaConversion('slider')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 1470, 870)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
    }

    public function categories()
    {
        return $this->belongsToMany(ContentCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(ContentTag::class);
    }

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->original = $file->getUrl('original');
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
            $file->slider = $file->getUrl('slider');
            $file->responsive = $file->getUrl('responsive');
        }

        return $file;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function postStaticSeos()
    {
        return $this->hasMany(StaticSeo::class, 'post_id', 'id');
    }

    public function staticSeo()
    {
        return $this->hasOne(StaticSeo::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
