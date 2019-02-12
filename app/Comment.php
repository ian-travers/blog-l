<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @property integer $id
 * @property string $author_name
 * @property string $author_email
 * @property string $author_url
 * @property string $body
 * @property integer $post_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $author
 */
class Comment extends Model
{
    protected $fillable = [
        'author_name', 'author_email', 'author_url', 'body', 'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return clean($this->body);
    }
}
