<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeletes;


class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable=[
        'data',
        'title',
        'content',
        'category_id',
    ];

    protected $casts=[
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
