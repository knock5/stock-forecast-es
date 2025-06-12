<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public $timestamps =  false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'level',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];
}
