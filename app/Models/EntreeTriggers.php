<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeTriggers extends Model
{
    use HasFactory;
    protected $fillable = ['dateEntree', 'quantiteEntree'];
}
