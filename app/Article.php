<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
     		'category_id',
            'name',
            'description',
            'price',
    ];

     public function categories()
    {
        return $this->belongsTo('App\Category');
    }

}
