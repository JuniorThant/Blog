<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogpost;
use App\Models\User;
use App\Models\Reply;


class Comment extends Model
{
    use HasFactory;

    public function blogpost()
    {
        return $this->belongsTo(Blogpost::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
