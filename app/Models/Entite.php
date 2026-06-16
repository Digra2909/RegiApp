<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    //
    protected $table = 'entites';

    protected $fillable = [
        'designationEntite',
        'direction_id',
    ];

    public function postes()
    {
        return $this->hasMany(Poste::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
