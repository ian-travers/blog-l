<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Post[] $posts
 */
class Category extends Model
{
    protected $fillable = [
        'title', 'slug',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($value) {

        $this->attributes['slug'] = str_slug($this->title);
    }
}
