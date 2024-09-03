<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Redirector.
 *
 * @property int $id
 * @property int|null $published
 * @property string|null $redirect_from
 * @property string|null $redirect_to
 * @property string|null $http_code
 * @property \Illuminate\Support\Carbon|null $added_on
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $post_id
 * @property-read \App\Models\Post|null $post
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector latest()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector newQuery()
 * @method static \Illuminate\Database\Query\Builder|Redirector onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector published()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector query()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereAddedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereHttpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereRedirectFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereRedirectTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirector whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Redirector withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Redirector withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Redirector extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const HTTP_CODE_SELECT = [
        '301' => '301',
        '302' => '302',
    ];

    public $table = 'redirectors';

    protected $dates = [
        'added_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'published',
        'redirect_from',
        'redirect_to',
        'http_code',
        'post_id',
        'added_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
