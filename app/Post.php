<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Post
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $body
 * @property null|string $image
 * @property integer $author_id
 * @property integer $views_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $published_at
 *
 * @property User $author
 */
class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'category_id', 'published_at', 'image'
    ];

    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsNumber(string $label = 'Comment')
    {
        $commentsNumber = $this->comments->count();
        return $commentsNumber . ' ' . str_plural($label, $commentsNumber);
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";
        $directory = config('cms.image.directory');

        if (!is_null($this->image)) {
            $imagePath = public_path() . "/{$directory}/" . $this->image;
            if (file_exists($imagePath)) {
                $imageUrl = asset("{$directory}/" . $this->image);
            }
        }

        return $imageUrl;
    }

    public function getImageThumbUrlAttribute()
    {
        $imageUrl = "";
        $directory = config('cms.image.directory');

        if (!is_null($this->image)) {
            $ext = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() . "/{$directory}/" . $thumbnail;
            if (file_exists($imagePath)) {
                $imageUrl = asset("{$directory}/" . $thumbnail);
            }
        }

        return $imageUrl;
    }

    public function getDateAttribute()
    {
        return is_null($this->created_at) ? '' : $this->created_at->diffForHumans();
    }

    public function getPublishedDateAttribute()
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body ? Markdown::convertToHTML(e($this->body)) : null;
    }

    public function getExcerptHtmlAttribute()
    {
        return $this->excerpt ? Markdown::convertToHTML(e($this->excerpt)) : null;
    }

    public function getTagsHtmlAttribute()
    {
        $anchors = [];

        foreach ($this->tags as $tag) {
            $anchors[] = '<a href="' . route('tag', $tag->slug) . '">' . $tag->name . '</a>';
        }

        return implode(', ', $anchors);

    }

    public function scopeLatestFirst(Builder $query)
    {
//        return $query->orderBy('created_at', 'desc');
        return $query->latest();
    }

    public function scopePopular(Builder $query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('published_at', '>', Carbon::now());
    }

    public function scopeDraft(Builder $query)
    {
        return $query->whereNull('published_at');
    }

    public static function archives()
    {
        return static::selectRaw('count(id) as post_count, year(published_at) year, monthname(published_at) month')
            ->published()
            ->groupBy('year', 'month')
            ->orderByRaw('min(published_at) desc')
            ->get();
    }

    public function scopeFilter($query, $filter)
    {
        if (isset($filter['month']) && $month = $filter['month']) {
            $query->whereRaw('month(published_at) = ?', [Carbon::parse($month)->month]);
        }

        if (isset($filter['year']) && $year = $filter['year']) {
            $query->whereRaw('year(published_at) = ?', [$year]);
        }

        if (isset($filter['term']) && $term = $filter['term']) {
            $query->where(function ($q) use ($term) {
                // search in the related model
                $q->whereHas('author', function ($qr) use ($term) {
                   $qr->where('name', 'like', "%{$term}%");
                });

                // search in the model
                $q->orWhere('title', 'like', "%{$term}%");
                $q->orWhere('excerpt', 'like', "%{$term}%");
            });
        }
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d-m-Y";
        if ($showTimes) $format = $format . " H:i:s";

        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (! $this->published_at) {
            return '<span class="badge badge-warning">Draft</span>';
        }

        if ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="badge badge-info badge-pill">Scheduled</span>';
        }

        return '<span class="badge badge-success badge-pill">Published</span>';
    }

    public function setSlugAttribute($value) {

        $this->attributes['slug'] = str_slug($this->title);
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? Carbon::createFromFormat('Y-m-d\TH:i', $value) : null;
    }

}


