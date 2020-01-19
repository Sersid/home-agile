<?php

namespace App\Models;

use App\Models\Ticket\Comment;
use App\Models\Ticket\Ticket;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property int $id
 * @package App\Models
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Аватар
     * @return string
     */
    public function avatar()
    {
        $avatarPath = '/upload/avatars/user-' . $this->id . '.jpg';
        $noAvatarPath = '/upload/avatars/no-avatar.png';
        return url(is_file(public_path() . $avatarPath) ? $avatarPath : $noAvatarPath);
    }

    /**
     * User tickets
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'created_user_id');
    }

    /**
     * User comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'created_user_id');
    }
}
