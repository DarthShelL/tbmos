<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainPageComponent extends Model
{
    protected $fillable = [
        'title',
        'description',
        'caption_color',
        'font_color'
    ];
}
