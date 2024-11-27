<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'opening_hours', 'budget']; // 必要なカラムを設定
}
