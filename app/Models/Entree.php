<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    use HasFactory;
    protected $fillable = ['idMedicament', 'stock', 'dernierEntree', 'dateDernierEntree', 'nombrePlaquetteEntree', 'nombreGraineEntree'];
}
