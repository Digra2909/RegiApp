<nav class="col-md-2 d-none d-md-block sidebar position-fixed p-4 d-flex flex-column vh-100 bg-dark text-light border-0 border-end border-secondary border-opacity-10">
    
    <!-- Zone Logo & Marque -->
    <div class="d-flex align-items-center gap-3 py-2 px-1">
        <img src="{{ asset('logos/logoRegidesi.png') }}" alt="REGIDESO S.A." class="img-fluid rounded-2" style="max-width: 38px; height: auto;">
        <div>
            <h5 class="text-white fw-bold m-0 small">RegiApp</h5>
            <small class="d-block text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.8px;">REGIDESO S.A.</small>
        </div>
    </div>
    
    <hr class="text-secondary opacity-25 my-4">

    <!-- Navigation Principale -->
    <div class="mb-auto w-100">
        <div class="fw-bold mb-3 px-2 text-info text-uppercase" style="font-size: 0.7rem; letter-spacing: 1.2px;">
            <i class="bi bi-folder2-open me-2"></i> DRK-E
        </div>
        
        <div class="list-group list-group-flush gap-1 bg-transparent w-100">
            <!-- Tableau de bord -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Equipement.index') }}">
                <i class="bi bi-grid-1x2-fill me-3"></i> 
                <span class="small fw-medium">Tableau de bord</span>
            </a>
            
             <!-- Gérer les directions -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Entite.create') }}">
                <i class="bi bi-plus-circle me-3"></i> 
                <span class="small fw-medium">Gérer les directions</span>
            </a>
            
            <!-- Gérer les entités -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Entite.create') }}">
                <i class="bi bi-layers me-3"></i> 
                <span class="small fw-medium">Gérer les entités</span>
            </a>

            <!-- Gérer les Postes -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Poste.create') }}">
                <i class="bi bi-geo-alt me-3"></i> 
                <span class="small fw-medium">Gérer les postes</span>
            </a>

            <!-- Gérer les équipements -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Equipement.create') }}">
                <i class="bi bi-tools me-3"></i> 
                <span class="small fw-medium">Gérer les équipements</span>
            </a>

            <!-- Logs Système -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="#">
                <i class="bi bi-terminal me-3"></i> 
                <span class="small fw-medium">Logs Système</span>
            </a>

            <!-- Paramètres -->
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="#">
                <i class="bi bi-gear me-3"></i> 
                <span class="small fw-medium">Paramètres</span>
            </a>
        </div>
    </div>

    <!-- Zone utilisateur et footer -->
    <div class="mt-auto pt-4 border-top border-secondary border-opacity-10">
        
        <div class="d-flex flex-column gap-2 mb-4">
            <a href="/login" class="btn btn-primary text-white fw-semibold py-2 d-flex align-items-center justify-content-center border-0 shadow-sm rounded-2 small">
                <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
            </a>
            
            <form action="" method="post" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-semibold d-flex align-items-center justify-content-center border-0 rounded-2 small text-secondary link-danger">
                    <i class="bi bi-power me-2"></i> Déconnexion
                </button>
            </form>
        </div>

        <div class="px-1 opacity-50">
            <p class="m-0 mb-1 text-secondary" style="font-size: 0.68rem;">
                Suivi d'infrastructure matériel
            </p>
            <span class="d-block text-secondary" style="font-size: 0.6rem;">
                &copy; gradidev026 &bull; Tous droits réservés
            </span>
        </div>
    </div>
</nav>