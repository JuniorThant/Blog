<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function blogposts()
    {
        return $this->hasMany(Blogpost::class);
    }

    public function likedBlogposts()
    {
        return $this->belongsToMany(Blogpost::class);
    }

    public function isSubscribed($blogpost)
    {
        return auth()->user()->likedBlogposts && 
        auth()->user()->likedBlogposts->contains('id', $blogpost->id);
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }
    
    public static function searchUsers($search)
    {
        return User::when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('username', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('is_admin', 'LIKE', '%' . $search . '%');
        })->get();
    }
}
