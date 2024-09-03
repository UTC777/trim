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

class Slider extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'sliders';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const LOCATION_SELECT = [
        '1' => 'HomePage',
        '2' => 'Blog',
        '3' => 'Products',
    ];

    protected $fillable = [
        'published',
        'slider_name',
        'location',
        'sub_title',
        'sub_title_css',
        'main_title',
        'main_title_css',
        'sub_title_2',
        'sub_title_2_css',
        'slider_description',
        'slider_description_css',
        'text_heading',
        'text_heading_css',
        'heading_1',
        'heading_1_css',
        'heading_2',
        'heading_2_css',
        'heading_3',
        'heading_3_css',
        'text',
        'text_css',
        'main_button_text',
        'main_button_link',
        'main_button_tab_index',
        'main_button_css',
        'main_button_icon_class',
        'second_button_text',
        'second_button_link',
        'second_button_tab_index',
        'second_button_css',
        'second_button_icon_class',
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
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
        $this->addMediaConversion('responsive')->format(Manipulations::FORMAT_WEBP)->width(1200)->height(500)->withResponsiveImages()->nonQueued();
        $this->addMediaConversion('slider')
            ->fit(Manipulations::FIT_CONTAIN, 1470, 1470) // Fit the image in 1920x1920, maintaining aspect ratio
            ->crop('crop-center', 1470, 870) // Then crop the resized image to your desired dimensions from the center
            ->format(Manipulations::FORMAT_WEBP) // Convert the format to WebP
            ->quality(100)
            ->withResponsiveImages() // Generate responsive images for different screen sizes
            ->nonQueued();
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
            $file->original = $file->getUrl('original');
            $file->slider = $file->getUrl('slider');
            $file->responsive = $file->getUrl('responsive');
        }

        return $file;
    }
}
