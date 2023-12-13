<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainPageBlock extends Model
{
    protected $casts = [
        'content' => 'array',
    ];

    // public static function boot()
    // {
    //     parent::boot();
    //     static::saving(function ($model) {
    //         if(empty($model->content['image'])) {
    //             $content = $model->content;
    //             $original = json_decode($model->getOriginal('content'), true);
    //             $content['image'] = array_get($original, 'image');
    //             $model->setAttribute('content', $content);
    //         }
    //     });
    // }
}
