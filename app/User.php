<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $bio
 * @property null|Carbon $email_verified_at
 * @property string $password
 * @property null|string $remember_token
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @property User $author
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBioHtmlAttribute()
    {
        return $this->bio ? Markdown::convertToHTML(e($this->bio)) : null;
    }

    public function gravatar()
    {
        $email = $this->email;
        $size = 100;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function getRegisteredAttribute()
    {
        return is_null($this->created_at) ? '' : $this->created_at;
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug(str_random() . '-' . $this->name);
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) $this->attributes['password'] = Hash::make($value);
    }
}
