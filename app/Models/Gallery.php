<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\CategoryService;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallery';
    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'category_service_id',
        'image',
    ];

    public function categoryService() {
        return $this->belongsTo(CategoryService::class, 'category_service_id');
    }
}
