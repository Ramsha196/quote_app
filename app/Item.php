<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['content', 'audio_id', 'background_image_id', 'application_id'];
    protected $table = 'items';
    public function categories() {
        return $this->belongsToMany(Category::class, 'category_item');

    }

    public function audio() {
        return $this->belongsTo(Media::class, 'audio_id');
    }

    public function background_image() {
        return $this->belongsTo(Media::class, 'background_image_id');
    }

    public function application() {
        return $this->belongsTo(Applications::class, 'application_id');
    }
    
}
