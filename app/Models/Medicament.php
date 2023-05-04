<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'denomination',
        'forme',
        'presentation',
        'coutUnitaire',
        'prixVente',
        'nombreParBoite',
        'dateExpiration',
        'userId'
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
