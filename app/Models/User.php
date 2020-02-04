<?php

namespace App\Models;

use App\Models\Ticket\Comment;
use App\Models\Ticket\Ticket;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @property int    $id
 * @property int    $sex
 * @property string $name
 * @property int    $vk
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    const MALE = 1;
    const FEMALE = 2;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
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
     * @return bool
     */
    public function isFemale()
    {
        return $this->sex === self::FEMALE;
    }

    /**
     * @param string $male
     * @param string $female
     *
     * @return string
     */
    public function genderVerb(string $male, string $female)
    {
        return $this->isMale() ? $male : $female;
    }

    /**
     * @return bool
     */
    public function isMale()
    {
        return $this->sex === self::MALE;
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
