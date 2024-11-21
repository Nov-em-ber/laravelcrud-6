<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // 保存する属性を指定
    protected $fillable = [
        'name',
        'phone',
        'email',
    ];
}
