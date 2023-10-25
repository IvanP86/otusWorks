<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Element;

class Category extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function elements()
    {
        return $this->hasMany(Element::class, 'element_id');
    }
}
