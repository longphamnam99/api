<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_post extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $table = 'product_post';

    protected $dates = ['deleted_at'];
}
