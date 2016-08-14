<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    
    protected $fillable = ['description', 'evaluation', 'user_id', 'post_id', 'comment_id', 'active'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

}
