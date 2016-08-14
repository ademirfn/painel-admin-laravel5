<?php

namespace App\Modules\Banners\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'title', 
            'subtitle', 
            'description', 
            'image', 
            'link',             
            'active'
        ];

    public function scopeActive($query)
    {
        return $query->where('active', 'Y');
    }
}
