<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'students';

    // Khóa chính
    protected $primaryKey = 'id';

    // Các cột có thể gán giá trị
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'parent_phone',
        'class_id',
    ];

    /**
     * Quan hệ với bảng classes
     * Học sinh thuộc về một lớp học
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
}
