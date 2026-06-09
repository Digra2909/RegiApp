<?php

namespace App\Livewire;

use App\Models\Entite;
use App\Models\Equipement;
use Livewire\Component;

class EquipementTable extends Component
{
    // Propriétés reliées aux champs de filtrage
    public $searchImmatriculation = '';

    public $filterEntite = '';

    public function render()
    {
        // On charge les équipements avec la relation poste et l'entité du poste
        $query = Equipement::with(['poste.entite']);

        // 1. Filtre par numéro d'immatriculation (si rempli)
        if (! empty($this->searchImmatriculation)) {
            $query->where('nImmoEquipement', 'like', '%'.$this->searchImmatriculation.'%');
        }

        // 2. Filtre par Entité en remontant la relation : Equipement -> Poste -> Entite
        if (! empty($this->filterEntite)) {
            $query->whereHas('poste', function ($q) {
                $q->where('entite_id', $this->filterEntite);
            });
        }

        return view('livewire.equipement-table', [
            'equipements' => $query->get(),
            'entites' => Entite::all(), // Nécessaire pour remplir le select des filtres
        ]);
    }
}
