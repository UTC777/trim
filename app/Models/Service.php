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
use Spatie\Image\Manipulations;

class Service extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'services';

    protected $appends = [
        'banner',
        'service_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'published',
        'title',
        'subtitle',
        'intro',
        'content',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', 1);
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
        $this->addMediaConversion('slider')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 1470, 870)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
        $this->addMediaConversion('service')
            ->fit(Manipulations::FIT_CONTAIN, 1920, 1920)
            ->crop('crop-center', 550, 400)
            ->format(Manipulations::FORMAT_WEBP)
            ->quality(80)
            ->withResponsiveImages()
            ->nonQueued();
    }

    public function getBannerAttribute()
    {
        $file = $this->getMedia('banner')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->original = $file->getUrl('original');
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->slider   = $file->getUrl('slider');
            $file->responsive   = $file->getUrl('responsive');
        }

        return $file;
    }

    public function getServicePhotoAttribute()
    {
        $file = $this->getMedia('service_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->original = $file->getUrl('original');
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->service   = $file->getUrl('service');
            $file->responsive   = $file->getUrl('responsive');
        }

        return $file;
    }
}
