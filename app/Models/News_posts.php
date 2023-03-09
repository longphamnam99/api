<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_posts extends Model
{
    use HasFactory;
    public $primaryKey = 'id';

    public $table = 'news_posts';

    protected $fillable = [
        'category_id', 
        'name',
        'introduce',
        'photo',
        'content',
        'pin',
        'new',
        'seo_title',
        'seo_description',
        'seo_keyword',
        'status',
        'viewed'
    ];

    protected $dates = ['deleted_at'];
}
