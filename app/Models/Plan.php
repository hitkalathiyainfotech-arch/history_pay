<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public $table = 'plans';

    public $fillable = [
        'plan_name',
        'price',
        'speed',
        'contract',
        'minimum_withdraw',
        'availability',
        'app_id',
        'category',
        'image',
        'image_path',
    ];
}
