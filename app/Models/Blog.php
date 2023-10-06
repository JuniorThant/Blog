<?php

namespace App\Models;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog
{
    public $title;
    public $filename;
    public $intro;
    public $body;
    public $date;
    public function __construct($title,$filename,$intro,$body,$date)
    {
        $this->title=$title;
        $this->filename=$filename;
        $this->intro=$intro;
        $this->body=$body;
        $this->date=$date;
    }
    public static function all()
    {
        return collect(File::files(resource_path("blogs")))->map(function($file){

            $obj=YamlFrontMatter::parseFile($file);
            return new Blog($obj->title,$obj->filename,$obj->intro,$obj->body(),$obj->date);
        })->sortByDesc('date');
    }
    public static function find($filename)
    {
        $blogs=static::all();
        return $blogs->firstWhere('filename',$filename);
    }
    public static function findOrFail($filename)
    {
        $blog= static::find($filename);
        if(!$blog)
        {
            abort('404');
        }
        return $blog;
    }
}