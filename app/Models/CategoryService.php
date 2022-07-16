<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Service;

class CategoryService extends Model
{
    use HasFactory;
    protected $table = 'category_service';
    protected $primaryKey = 'category_service_id';

    protected $fillable = [
        'category_service_id',
        'name',
        'image',
    ];

    public function service() {
        return $this->hasMany(Service::class, 'category_service_id');
    }

    public function gallery() {
        return $this->hasMany(Gallery::class, 'category_service_id');
    }



}
