<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;
    protected $fillable = [
        'idMedicament',
        'type',
        'provDest',
        'quantiteEntree',
        'quantiteSortie',
        'lot',
        'observation',
        'date',
    ];
}
