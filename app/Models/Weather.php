<?php

namespace App\Models;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Weather
{
    public $title;
    public $slug;
    public $info;
    public $body;
    public function __construct($title,$slug,$info,$body)
    {
        $this->title=$title;
        $this->slug=$slug;
        $this->info=$info;
        $this->body=$body;

    }

    public static function all()
    {
        return collect(File::files(resource_path("weatherblog")))->map(function($weather){
            $obj=YamlFrontMatter::parseFile($weather);
            return new Weather($obj->title,$obj->slug,$obj->info,$obj->body());
        });
    }
    
    public static function find($slug)
    {
        $texts=static::all();
        return $texts->firstWhere('slug',$slug);
    }

}