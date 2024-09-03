<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class Pagesection extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    public $table = 'page_sections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'published',
        'use_editor',
        'custom_class',
        'default_section_classes',
        'section_title',
        'section',
        'section_nickname',
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
        'select_crud_section',
        'use_crud_section',
        'ps_cdn_css',
        'ps_cdn_js',
        'ps_js',
        'ps_css',
        'use_full_width_section',
    ];

    public const DEFAULT_SECTION_CLASSES_SELECT = [
        'no-pad'          => 'Section Top & Bottom No Spacing',
        'ptb-100'          => 'Section Top & Bottom Spaced 100px',
        'pb-100'           => 'Section Bottom Spaced 100px',
        'pt-100'           => 'Section Top Spaced 100px',
        'ptb-20'          => 'Section Top & Bottom Spaced 20px',
        'pt-100 pb-70'     => 'Section Top & Bottom Spaced 100px/70px',
        'bg-color ptb-100' => 'Default With Background Color',
    ];

    protected $appends = [
        'section_preview',
    ];

    public const SELECT_CRUD_SECTION = [
        '1'  => 'Latest post section',
        '2'  => 'Testimonials',
        '3'  => 'Success Stories',
        '4'  => 'As Seen On',
        '5'  => 'Services',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    protected static function booted()
    {
        static::saved(function ($pagesection) {
            Cache::forget("pagesection_{$pagesection->id}");
        });

        static::deleted(function ($pagesection) {
            Cache::forget("pagesection_{$pagesection->id}");
        });
    }

    public static function getCached($id)
    {
        return Cache::remember("pagesection_{$id}", now()->addWeek(), function () use ($id) {
            return static::with(['relationships'])->findOrFail($id); // Adjust 'relationships' as needed
        });
    }

    public function pages()
    {
        return $this->belongsToMany(ContentPage::class,'page_pagesection','pagesection_id','page_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assign_pages()
    {
        return $this->belongsToMany(ContentPage::class,'page_pagesection','pagesection_id','page_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')->format(Manipulations::FORMAT_WEBP)->nonQueued();
        $this->addMediaConversion('thumb')->format(Manipulations::FORMAT_WEBP)->width(150)->height(150)->nonQueued();
        $this->addMediaConversion('preview')->format(Manipulations::FORMAT_WEBP)->width(120)->height(120)->nonQueued();
    }

    public function getSectionPreviewAttribute()
    {
        $file = $this->getMedia('section_preview')->last();

        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('original');
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }

        return $file;
    }
}
