<nav class="col-md-2 d-none d-md-block sidebar position-fixed p-4 d-flex flex-column vh-100 bg-dark text-light rounded-0 border-0" style="border-right: 1px solid rgba(255,255,255,0.05) !important;">
    
    <div class="d-flex align-items-center gap-3 py-2 px-1">
        <img src="{{ asset('logos/logoRegidesi.png') }}" alt="Logo App" class="img-fluid rounded-0" style="max-width: 40px; height: auto;">
        <div>
            <h5 class="text-white fw-bold m-0" style="font-size: 1.05rem; letter-spacing: 0.5px;">RegiApp</h5>
            <small class="text-white-50 d-block" style="font-size: 0.65rem; letter-spacing: 1px; text-transform: uppercase;">Regideso DDK</small>
        </div>
    </div>
    
    <hr class="text-white border-top border-1 opacity-10 my-4">

    <div class="mb-auto w-100">
        <div class="text-info fw-bold mb-3 px-2" style="font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase; opacity: 0.9;">
            <i class="bi bi-folder2-open me-2"></i> DRK - EST
        </div>
        
        <div class="list-group list-group-flush gap-1 bg-transparent w-100">
            <a class="list-group-item list-group-item-action bg-transparent text-white-50 py-2.5 px-3 rounded-0 border-0 d-flex align-items-center dynamic-link" href="{{ route('Entite.create') }}">
                <i class="bi bi-layers me-3 text-info"></i> <span>Gérer les entités</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-white-50 py-2.5 px-3 rounded-0 border-0 d-flex align-items-center dynamic-link" href="{{ route('Poste.create') }}">
                <i class="bi bi-geo-alt me-3 text-info"></i> <span>Gérer les Postes</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-white-50 py-2.5 px-3 rounded-0 border-0 d-flex align-items-center dynamic-link" href="{{ route('Equipement.create') }}">
                <i class="bi bi-tools me-3 text-info"></i> <span>Gérer les équipements</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-white-50 py-2.5 px-3 rounded-0 border-0 d-flex align-items-center dynamic-link" href="{{ route('Equipement.index') }}">
                <i class="bi bi-speedometer2 me-3 text-info"></i> <span>Tableau de bord</span>
            </a>
        </div>
    </div>

    <div class="mt-auto pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
        
        <div class="d-flex flex-column gap-2 mb-4">
            <a href="/login" class="btn btn-info w-100 rounded-0 text-white fw-bold py-2 d-flex align-items-center justify-content-center border-0" style="font-size: 0.9rem; letter-spacing: 0.5px;">
                <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
            </a>
            
            <form action="" method="post" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-0 py-2 fw-semibold d-flex align-items-center justify-content-center text-white-50 border-0 dynamic-logout" style="font-size: 0.9rem;">
                    <i class="bi bi-power me-2"></i> Déconnexion
                </button>
            </form>
        </div>

        <div class="px-1" style="line-height: 1.3;">
            <p class="text-white-50 m-0 mb-1" style="font-size: 0.68rem; opacity: 0.6;">
                Application de gestion des équipements
            </p>
            <span class="text-white-50 d-block" style="font-size: 0.6rem; opacity: 0.4;">
                &copy; gradidev026 • Tous droits réservés
            </span>
        </div>
    </div>
</nav>

<style>
    /* Change la couleur du texte et ajoute un léger fond gris transparent au survol des liens */
    .dynamic-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.05) !important;
    }
    /* Effet discret mais efficace pour la déconnexion qui passe au rouge fluide */
    .dynamic-logout:hover {
        background-color: rgba(220, 53, 69, 0.1) !important;
        color: #dc3545 !important;
    }
</style>