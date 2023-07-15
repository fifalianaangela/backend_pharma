<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'denomination',
        'forme',
        'presentation',
        'prixVente',
        'nombreParBoite',
        'dateExpiration',
        'userId',
        'unite'
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
