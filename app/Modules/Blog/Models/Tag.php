<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $fillable = ['name'];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
