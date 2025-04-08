<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';
    
    protected $fillable = [
        'name'
    ];

    public function products(){
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
