<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paperwork extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'isGenerated',
        'filePath',
        'clubId',
        'paperworkDetailsId',
        'isOneDay',
        'programDate',
        'programDateStart',
        'programDateEnd',
        'venue',
        'collaborations',
        'status',
        'currentProgressState',
        'progressStates',
        'created_at',
        'updated_at',
    ];
}
