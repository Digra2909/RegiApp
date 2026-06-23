<?php

namespace App\Livewire;

use App\Models\Entite;
use App\Models\Equipement;
use Livewire\Component;

class EquipementTable extends Component
{
    public $searchImmatriculation = '';

    public $filterEntite = '';

    public function render()
    {
        $query = Equipement::with(['poste.entite']);

        if (! empty($this->searchImmatriculation)) {
            $query->where('nImmoEquipement', 'like', '%'.$this->searchImmatriculation.'%');
        }

        if (! empty($this->filterEntite)) {
            $query->whereHas('poste', function ($q) {
                $q->where('entite_id', $this->filterEntite);
            });
        }

        return view('livewire.equipement-table', [
            'equipements' => $query->get(),
            'entites' => Entite::all(), // pour le select des filtres
        ]);
    }
}
