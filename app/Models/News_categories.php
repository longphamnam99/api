<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_categories extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $table = 'news_categories';

    protected $fillable = [
        'title', 
        'description',
        'image',
        'icon',
        'seo_desc',
        'seo_key',
        'seo_title',
        'status'
    ];

    protected $dates = ['deleted_at'];
}
