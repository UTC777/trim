<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentSection extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const LOCATION_SELECT = [
        'page_top'       => 'CS: Page Top',
        'content_top'    => 'CS: Content Top',
        'content_bottom' => 'CS: Content Bottom',
        'page_bottom'    => 'CS: Page Bottom',
    ];

    public $table = 'content_sections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'section_title',
        'order',
        'section',
        'location',
        'published',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
    
    public function pages()
    {
        return $this->belongsToMany(ContentPage::class,'content_section_page','content_section_id','page_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assign_contentPages()
    {
        return $this->belongsToMany(ContentPage::class,'content_section_page','content_section_id','page_id');
    }
}
