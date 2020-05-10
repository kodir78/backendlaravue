<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maatwebsite\Excel\Concerns\ToModel;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    // protected $fillable = [
    //     'title', 'type', 'price', 'description', 'quantity', 'slug',
    // ];
    
    //
    protected $hidden = [
        
    ];

    // public function gallery()
    // {
    //     return $this->hasMany(ProductGallery::class, 'products_id');
    // }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class,'products_id');
    }

}
