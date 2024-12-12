<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $primaryKey = 'sale_id'; // Định nghĩa khóa chính

    protected $fillable = [
        'medicine_id', 'quantity', 'sale_date', 'customer_phone'
    ];

    // Định nghĩa mối quan hệ với bảng medicines (một đơn bán thuộc về một loại thuốc)
    // public function medicine()
    // {
    //     return $this->belongsTo(Medicines::class, 'medicine_id'); 
    // }
}
