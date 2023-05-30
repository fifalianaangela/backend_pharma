<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenteJournalier extends Model
{
    use HasFactory;

    protected $fillable = ['idMedicament', 'vente', 'dateVente','prixTotal'];
}
