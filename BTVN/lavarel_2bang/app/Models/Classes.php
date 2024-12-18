<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    // Tên bảng
    protected $table = 'classes';

    // Khóa chính
    protected $primaryKey = 'id';

    // Các cột có thể gán giá trị
    protected $fillable = [
        'grade_level',
        'room_number',
    ];

    /**
     * Quan hệ với bảng students
     * Một lớp học có nhiều học sinh
     */
    public function students()
    {
        return $this->hasMany(Students::class, 'class_id', 'id');
    }
}
