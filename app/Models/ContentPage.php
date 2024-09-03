<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use App\Models\StaticSeo;

class ContentPage extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'content_pages';

    protected $appends = [
        'photo',
        'attachments',
        'featured_image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sub_title',
        'excerpt',
        'path',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
        'published',
        'meta_title',
        'meta_description',
        'facebook_title',
        'facebook_description',
        'twitter_title',
        'twitter_description',
        'use_textonly_header',
        'show_title',
        'show_tagline',
        'show_featured_content',
        'featured_image_content',
        'use_svg_header',
        'use_featured_image_header',
        'svg_masthead',
        'title_style',
        'tagline_style',
        'fi_content_style',
        'add_to_sitemap',
        'custom_css',
        'use_rev_slider',
        'path2',
        'path3',
        'path4',
        'path_segments',
        'is_homepage',
        'nickname',
    ];

    public const TITLE_STYLE_SELECT = [

        'text-primary bg-light'   => 'Primary',
        'text-secondary bg-dark'  => 'Secondary',
        'text-light bg-dark'      => 'Light',
        'text-dark  bg-light'        => 'Dark',
        'text-primary'   => 'Primary No BG',
        'text-secondary'  => 'Secondary No BG',
        'text-light'      => 'Light No BG',
        'text-dark'      => 'Dark No BG',
        'text-primary bg-dark p-2'    => 'Primary BG Dark',
        'text-primary bg-light p-2'   => 'Primary BG Light',
        'text-secondary bg-dark p-2'  => 'Secondary BG Dark',
        'text-secondary bg-light p-2' => 'Secondary BG Light',
        'text-light bg-dark p-2'      => 'Light BG Dark',
        'text-dark bg-light p-2'      => 'Dark BG Light',
        '' => 'None',
    ];

    public const TAGLINE_STYLE_SELECT = [

        'text-primary bg-light'   => 'Primary',
        'text-secondary bg-dark'  => 'Secondary',
        'text-light bg-dark'      => 'Light',
        'text-dark bg-light'      => 'Dark',
        'text-primary'   => 'Primary No BG',
        'text-secondary'  => 'Secondary No BG',
        'text-light'      => 'Light No BG',
        'text-dark'      => 'Dark No BG',
        'text-primary bg-dark p-2'    => 'Primary BG Dark',
        'text-primary bg-light p-2'   => 'Primary BG Light',
        'text-secondary bg-dark p-2'  => 'Secondary BG Dark',
        'text-secondary bg-light p-2' => 'Secondary BG Light',
        'text-light bg-dark p-2'      => 'Light BG Dark',
        'text-dark bg-light p-2'      => 'Dark BG Light',
        '' => 'None',
    ];

    public const FI_CONTENT_STYLE_SELECT = [
        '' => 'None',
        'text-primary bg-light'   => 'Primary',
        'text-secondary bg-dark'  => 'Secondary',
        'text-light  bg-dark'     => 'Light',
        'text-dark bg-light'      => 'Dark',
        'text-primary'   => 'Primary No BG',
        'text-secondary'  => 'Secondary No BG',
        'text-light'      => 'Light No BG',
        'text-dark'      => 'Dark No BG',
        'text-primary bg-dark p-2'    => 'Primary BG Dark',
        'text-primary bg-light p-2'   => 'Primary BG Light',
        'text-secondary bg-dark p-2'  => 'Secondary BG Dark',
        'text-secondary bg-light p-2' => 'Secondary BG Light',
        'text-light bg-dark p-2'      => 'Light BG Dark',
        'text-dark bg-light p-2'      => 'Dark BG Light',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    protected static function booted()
    {
        static::saved(function ($contentPage) {
            Cache::forget("content_page_{$contentPage->id}");
        });

        static::deleted(function ($contentPage) {
            Cache::forget("content_page_{$contentPage->id}");
        });
    }

    public static function getCached($id)
    {
        return Cache::remember("content_page_{$id}", now()->addWeek(), function () use ($id) {
            return static::with(['categories', 'tags', 'pagesContentSections', 'pagesPagesections'])->findOrFail($id);
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
        $this->addMediaConversion('slider')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 1470, 870)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
        $this->addMediaConversion('masthead')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 1920, 760)
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

    public function sliders()
    {
        return $this->belongsToMany(Slider::class);
    }

    public function pagesContentSections()
    {
        return $this->belongsToMany(ContentSection::class,'content_section_page','page_id','content_section_id')->orderBy('order', 'ASC');
    }

    public function pagesFrontContentSections()
    {
        return $this->belongsToMany(ContentSection::class,'content_section_page','page_id','content_section_id')->published()->orderBy('order', 'ASC');
    }

    public function pagesPagesections()
    {
        return $this->belongsToMany(Pagesection::class,'page_pagesection','page_id','pagesection_id')->orderBy('order', 'ASC');
    }

    public function pagesFrontPagesections()
    {
        return $this->belongsToMany(Pagesection::class,'page_pagesection','page_id','pagesection_id')->published()->orderBy('order', 'ASC');
    }

    public function pageSection_CrudSections()
    {
        return $this->belongsToMany(PageSection::class,'page_pagesection','page_id','pagesection_id')->where('use_crud_section', '!=', 0)->orderBy('order', 'ASC');
    }

    public function pageStaticSeos()
    {
        return $this->hasMany(StaticSeo::class, 'page_id', 'id');
    }

    public function staticSeo()
    {
        return $this->hasOne(StaticSeo::class, 'page_id', 'id');
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
            $file->masthead = $file->getUrl('masthead');
            $file->responsive = $file->getUrl('responsive');

        }

        return $file;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->photo   = $file->getUrl('photo');
            $file->slider = $file->getUrl('slider');
            $file->masthead = $file->getUrl('masthead');
            $file->responsive = $file->getUrl('responsive');
        }

        return $file;
    }

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }
}
