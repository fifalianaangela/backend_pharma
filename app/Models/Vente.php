<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    protected $fillable = ['idMedicament', 'quantiteVendu', 'prixTotal', 'dateVente', 'acheteur', 'dateExpiration'];
}
