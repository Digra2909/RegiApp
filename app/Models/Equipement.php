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
        'ram',
        'disque_dur',
        'cpu',
        'Observation',
        'dateAcc',
        'poste_id',
    ];

    public function getAutreSpecTechAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        $parts = [];
        if (!empty($this->attributes['ram'] ?? null)) {
            $parts[] = $this->attributes['ram'];
        }
        if (!empty($this->attributes['disque_dur'] ?? null)) {
            $parts[] = $this->attributes['disque_dur'];
        }
        if (!empty($this->attributes['cpu'] ?? null)) {
            $parts[] = $this->attributes['cpu'];
        }

        return $parts ? implode(' | ', $parts) : null;
    }

    public function poste()
    {
        return $this->belongsTo(Poste::class);
    }
}
