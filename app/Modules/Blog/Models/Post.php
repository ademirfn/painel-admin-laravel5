<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'slug', 'subtitle', 'content', 'image', 'active'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    
    public function getTagsId($tags_request)
    {        
        $tags = explode(',', $tags_request);
        $tagCollection = [];
        for ($i=0; $i < count($tags); $i++) { 
            $tags[$i] = ltrim($tags[$i]);
            $tag = Tag::firstOrCreate(['name'=>$tags[$i]]);
            if ($tag !== true){
                array_push($tagCollection, $tag->id);
            } 
        } 
        return $tagCollection;
    }
}
