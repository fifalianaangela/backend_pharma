<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomMedicament',
        'codeProduit',
        'quantite',
        'coutUnitaire',
        'prixVente',
        'nombrePlaquette'
    ];
    
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
