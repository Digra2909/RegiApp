<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    protected $table = 'postes';

    protected $fillable = [
        'designationPoste',
        'nomResponsble',
        'entite_id',
    ];

    public function entite()
    {
        return $this->belongsTo(Entite::class);
    }

    public function equipements()
    {
        return $this->hasMany(Equipement::class);
    }
}
