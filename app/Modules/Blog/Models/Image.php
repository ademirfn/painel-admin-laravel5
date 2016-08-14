<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['extension', 'cover', 'post_id', 'created_at'];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
