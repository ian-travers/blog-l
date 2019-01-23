<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $published_at
 *
 * @property User $author
 */
class Post extends Model
{
    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";

        if (!is_null($this->image)) {
            $imagePath = public_path() . "/img/" . $this->image;
            if (file_exists($imagePath)) {
                $imageUrl = asset('img/' . $this->image);
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

    public function scopeLatestFirst(Builder $query)
    {
//        return $query->orderBy('created_at', 'desc');
        return $query->latest();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}


