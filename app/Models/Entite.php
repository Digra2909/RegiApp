<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    //
    protected $table = 'entites';

    protected $fillable = [
        'designationEntite',
    ];

    public function postes()
    {
        return $this->hasMany(Poste::class);
    }
}
