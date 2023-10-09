<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function blogposts()
    {
        return $this->hasMany(Blogpost::class);
    }

	public static function getFilteredCategories($search)
	{
	    return Category::when($search, function ($query) use ($search) {
	        $query->where('name', 'LIKE', '%' . $search . '%');
	    })->get();
	}

}
