<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name', 'path', 'type'];

    public function audioItem() {
        return $this->hasMany(Item::class, 'audio_id');
    }

    public function backgroundImageItem() {
        return $this->hasMany(Item::class, 'background_image_id');
    }
}
