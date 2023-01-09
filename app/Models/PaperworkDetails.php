<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperworkDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'introduction',
        'background',
        'objective',
        'learningOutcome',
        'theme',
        'organizedBy',
        'targetGroup',
        'dateVenueTime',
        'tentativeFirebaseId',
        'financialImplicationFirebaseId',
        'programCommittee',
        'closing',
        'signature',
        'created_at',
        'updated_at'
    ];
}
