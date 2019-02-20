<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['category_name'];

    use SoftDeletes;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item');
    }
}


