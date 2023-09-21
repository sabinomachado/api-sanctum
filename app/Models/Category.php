<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'name',
      ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

}
