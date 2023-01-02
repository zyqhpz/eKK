<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paperwork extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'isGenerated', 'filePath', 'clubId', 'paperworkDetailsId', 'created_at', 'updated_at'
    ];

    // add function to create a new paperwork
    // public static function create($name, $isGenerated, $filepath)
    // {
    //     $paperwork = new Paperwork();
    //     $paperwork->name = $name;
    //     $paperwork->isGenerated = $isGenerated;
    //     $paperwork->filePath = $filepath;
    //     $paperwork->save();
    // }
}
