<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\CategoryService;
use App\Models\Reservation;

class Service extends Model
{
    use HasFactory;
    protected $table = 'service';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'category_service_id',
        'name',
        'price',
        'image',
    ];

    public function categoryService()
    {
        return $this->belongsTo(CategoryService::class, 'category_service_id');
    }
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'service_id');
    }
}
