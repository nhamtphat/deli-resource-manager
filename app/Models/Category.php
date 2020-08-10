<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $timestamps = false;
    protected $fillable = ['name'];
    
    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
