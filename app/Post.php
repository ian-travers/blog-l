<?php

namespace App;

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
 *
 * @property User $author
 */
class Post extends Model
{
    public function getImageUrlAttribute()
    {
        $imageUrl = "";

        if (! is_null($this->image)) {
            $imagePath = public_path() . "/img/" . $this->image;
             if (file_exists($imagePath)) {
                 $imageUrl = asset('img/' . $this->image);
             }
        }

        return $imageUrl;
    }
}
