<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['cle', 'valeur'];

    public static function getValeur($cle, $defaut = null)
    {
        return self::where('cle', $cle)->first()?->valeur ?? $defaut;
    }

    public static function setValeur($cle, $valeur)
    {
        return self::updateOrCreate(['cle' => $cle], ['valeur' => $valeur]);
    }
}

