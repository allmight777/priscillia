<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';
    protected $fillable = [
        'email',
        'telephone',
        'adresse',
        'jours_ouverture',
        'heures_ouverture',
    ];
}
