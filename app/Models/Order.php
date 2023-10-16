<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Element;
use App\Models\OrderElemet;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function elements()
    {
        return $this->belongsToMany(Element::class, 'order_elements', 'element_id', 'order_id' );
    }
}
