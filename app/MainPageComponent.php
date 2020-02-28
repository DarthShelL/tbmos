<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainPageComponent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'screen_image'
    ];
}
