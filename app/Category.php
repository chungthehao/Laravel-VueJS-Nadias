<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
