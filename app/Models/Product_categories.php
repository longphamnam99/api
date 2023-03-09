<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_categories extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    public $table = 'product_categories';

    protected $fillable = [
        'code', 
        'photo',
        'seo_title',
        'seo_description',
        'seo_keyword',
        'status'
    ];

    protected $dates = ['deleted_at'];
}
