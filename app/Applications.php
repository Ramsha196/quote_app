<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $fillable = ['name'];

    protected $table = 'applications';

    public function item() {
        return $this->hasMany(Item::class, 'application_id');
    }
}
