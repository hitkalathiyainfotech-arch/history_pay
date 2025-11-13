<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;
    public $table = 'api_logs';

    public $fillable = [
        'api_name',
    ];

    // public function yourApiMethod(Request $request)
    // {
    //     ApiLog::create([
    //         'api_name' => $apiName,
    //     ]);
    // }
}
