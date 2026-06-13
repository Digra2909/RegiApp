<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    //
    protected $table = 'directions';

    protected $fillable = [
        'designationDirection',
        'codeDirection',
        'nomDirecteur',
    ];

    public function entites()
    {
        return $this->hasMany(Entite::class);
    }
}
