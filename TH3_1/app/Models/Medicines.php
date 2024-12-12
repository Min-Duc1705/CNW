<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Medicines extends Model
{
    use HasFactory;
    protected $primaryKey = 'medicine_id';
    protected $fillable = [
        'name',
        'brand',
        'dosage',
        'form',
        'price',
        'stock' 
    ];
    // public function sales()
    // {
    //     return $this->hasMany(Sale::class, 'medicine_id');
    // }
}
