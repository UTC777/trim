<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Image;
use Illuminate\Support\Facades\Cache;
use Spatie\Image\Manipulations;

class StaticSeo extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'static_seos';

    protected $appends = [
        'seo_image',
    ];

    protected static function booted()
    {
        parent::boot();

        static::updating(function ($staticSeo) {
            // Set deactivate_update to true to prevent the content from changing
            // once it is manually updated in SEO itself.
            // Turns off auto-update. This way, once it's set to what you want,
            // it won't change unless you manually change it in SEO.

            $staticSeo->deactivate_update = true;
            Cache::forget("static_seo_{$staticSeo->id}");
        });

        static::deleted(function ($staticSeo) {
            Cache::forget("static_seo_{$staticSeo->id}");
        });
    }

    public static function getCached($id)
    {
        return Cache::remember("static_seo_{$id}", now()->addWeek(), function () use ($id) {
            return static::findOrFail($id);
        });
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const OPEN_GRAPH_TYPE_SELECT = [
        'website' => 'Website',
        'article' => 'Article',
        'product' => 'Product',
    ];

    public const CONTENT_TYPE_SELECT = [
        'custom'     => 'Pages Builder',
        'post'       => 'Blog Post',
        'product'    => 'Product',
        'faq'        => 'FAQ',
    ];

    protected $fillable = [
        'deactivate_update',
        'page_name',
        'page_path',
        'post_id',
        'product_id',
        'meta_title',
        'facebook_title',
        'twitter_title',
        'content_type',
        'json_ld_tag',
        'canonical',
        'html_schema_1',
        'html_schema_2',
        'html_schema_3',
        'body_schema',
        'facebook_description',
        'twitter_description',
        'meta_description',
        'open_graph_type',
        'menu_name',
        'seo_image_url',
        'noindex',
        'nofollow',
        'noimageindex',
        'noarchive',
        'nosnippet',
        'footer_classes',
        'main_classes',
        'body_classes',
        'html_classes',
        'meta_title_check',
        'meta_desc_check',
        'facebook_title_check',
        'facebook_desc_check',
        'twitter_title_check',
        'twitter_desc_check',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('thumb')->format(Manipulations::FORMAT_WEBP)->width(150)->height(150)->nonQueued();
        $this->addMediaConversion('preview')->format(Manipulations::FORMAT_WEBP)->width(120)->height(120)->nonQueued();
    }

    public function getSeoImageAttribute()
    {
        $file = $this->getMedia('seo_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->original   = $file->getUrl('original');
        }

        return $file;
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function page()
    {
        return $this->belongsTo(ContentPage::class, 'page_id');
    }
}
