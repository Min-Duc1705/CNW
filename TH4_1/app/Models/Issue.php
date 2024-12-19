<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Computer; // Sửa lại import tên class từ Computers thành Computer

class Issue extends Model
{
    protected $fillable = [
        'computer_id',
        'reported_by',
        'reported_date',
        'description',
        'urgency',
        'status',
    ];

    // Quan hệ với bảng computers (nhiều-1)
    public function computer()
    {
        return $this->belongsTo(Computer::class); // Sửa lại tên class từ Computers thành Computer
    }
}
