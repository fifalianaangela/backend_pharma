<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomMedicament',
        'codeProduit',
        'quantite',
        'coutUnitaire',
        'prixVente',
        'nombrePlaquette',
    ];

    protected function entree()
    {
        return $this->hasMany(Entree::class, 'idMedicament');
    }
}
