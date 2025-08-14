<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    protected $fillable = ['jour', 'heure_ouverture', 'heure_fermeture'];
}
