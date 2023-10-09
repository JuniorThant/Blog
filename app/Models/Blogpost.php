<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Blogpost extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function scopeFilter($query,$filter)
    {
        $query->when($filter['search']??false, function($query, $search){
            $query->where(function($query) use ($search){
                $query->where('blogtitle','LIKE','%'.$search.'%')
            ->orWhere('blogbody','LIKE','%'.$search.'%');
            });
        });

        $query->when($filter['category']??false,function($query,$filename){
            $query->whereHas('category',function($query) use($filename){
                $query->where('filename',$filename);
            });
        });

        $query->when($filter['author']??false,function($query,$username){
            $query->whereHas('author',function($query) use($username){
                $query->where('username',$username);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class,'blogpost_user');
    }

    public function unSubscribe()
    {
        $this->subscribers()->detach(auth()->id());
    }
    
    public function Subscribe()
    {
        $this->subscribers()->attach(auth()->id());
    }
}
