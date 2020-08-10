<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'download_link', 'preview_img', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
