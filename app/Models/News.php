<?php
// app/Models/News.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'type',
        'category',
        'is_live',
        'is_trending',
        'views',
        'status',
        'user_id'
    ];

    protected $casts = [
        'is_live' => 'boolean',
        'is_trending' => 'boolean',
    ];
}