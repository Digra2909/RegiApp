<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    //
    protected $table = 'equipements';

    protected $fillable = [
        'designationEquipement',
        'NserieEquipement',
        'nImmoEquipement',
        'autreSpecTech',
        'Observation',
        'dateAcc',
        'poste_id',
    ];

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }
}
