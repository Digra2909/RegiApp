<!-- Desktop sidebar -->
<aside class="col-md-2 d-none d-md-block sidebar position-fixed p-4 d-flex flex-column vh-100 bg-dark text-light border-0 border-end border-secondary border-opacity-10">
    <div class="d-flex align-items-center gap-3 py-2 px-1">
        <img src="{{ asset('logos/logoRegidesi.png') }}" alt="REGIDESO S.A." class="img-fluid rounded-2" style="max-width: 38px; height: auto;">
        <div>
            <h5 class="text-white fw-bold m-0 small">RegiApp</h5>
            <small class="d-block text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.8px;">REGIDESO S.A.</small>
        </div>
    </div>

    <hr class="text-secondary opacity-25 my-4">

    <div class="mb-auto w-100">
        <div class="fw-bold mb-3 px-2 text-info text-uppercase" style="font-size: 0.7rem; letter-spacing: 1.2px;">
            <i class="bi bi-folder2-open me-2"></i> DRK-E
        </div>

        <div class="list-group list-group-flush gap-1 bg-transparent w-100">
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Equipement.index') }}">
                <i class="bi bi-grid-1x2-fill me-3"></i>
                <span class="small fw-medium">Tableau de bord</span>
            </a>
            @hasanyrole('admin|operateur')
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('global') }}">
                <i class="bi bi-speedometer2 me-3"></i>
                <span class="small fw-medium">Dashboard global</span>
            </a>
            @endhasanyrole
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Direction.create') }}">
                <i class="bi bi-plus-circle me-3"></i>
                <span class="small fw-medium">Gérer les directions</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Entite.create') }}">
                <i class="bi bi-layers me-3"></i>
                <span class="small fw-medium">Gérer les entités</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Poste.create') }}">
                <i class="bi bi-geo-alt me-3"></i>
                <span class="small fw-medium">Gérer les postes</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('Equipement.create') }}">
                <i class="bi bi-tools me-3"></i>
                <span class="small fw-medium">Gérer les équipements</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="#">
                <i class="bi bi-terminal me-3"></i>
                <span class="small fw-medium">Logs Système</span>
            </a>
            <a class="list-group-item list-group-item-action bg-transparent text-secondary border-0 d-flex align-items-center rounded-2 py-2.5 px-3 link-light" href="{{ route('settings.users.index') }}">
                <i class="bi bi-gear me-3"></i>
                <span class="small fw-medium">Paramètres</span>
            </a>
        </div>
    </div>

    <div class="mt-auto pt-4 border-top border-secondary border-opacity-10">
        <div class="d-flex flex-column gap-2 mb-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary text-white fw-semibold py-2 d-flex align-items-center justify-content-center border-0 shadow-sm rounded-2 small">
                <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
            </a>
            <form action="{{ route('logout') }}" method="post" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-semibold d-flex align-items-center justify-content-center border-0 rounded-2 small text-secondary link-danger">
                    <i class="bi bi-power me-2"></i> Déconnexion
                </button>
            </form>
        </div>
        <div class="px-1 opacity-50">
            <p class="m-0 mb-1 text-secondary" style="font-size: 0.68rem;">Suivi d'infrastructure matériel</p>
            <span class="d-block text-secondary" style="font-size: 0.6rem;">&copy; gradidev026 &bull; Tous droits réservés</span>
        </div>
    </div>
</aside>

<!-- Offcanvas mobile menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavLabel">RegiApp</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-3 bg-dark text-light">
            <div class="d-flex align-items-center gap-3 py-2 px-1">
                <img src="{{ asset('logos/logoRegidesi.png') }}" alt="REGIDESO" style="max-width:34px;">
                <div>
                    <div class="fw-bold">RegiApp</div>
                    <small class="text-muted">REGIDESO S.A.</small>
                </div>
            </div>
        </div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action" href="{{ route('Equipement.index') }}">Tableau de bord</a>
            <a class="list-group-item list-group-item-action" href="{{ route('Direction.create') }}">Gérer les directions</a>
            <a class="list-group-item list-group-item-action" href="{{ route('Entite.create') }}">Gérer les entités</a>
            <a class="list-group-item list-group-item-action" href="{{ route('Poste.create') }}">Gérer les postes</a>
            <a class="list-group-item list-group-item-action" href="{{ route('Equipement.create') }}">Gérer les équipements</a>
            <a class="list-group-item list-group-item-action" href="#">Logs Système</a>
            <a class="list-group-item list-group-item-action" href="{{ route('settings.users.index') }}">Paramètres</a>
        </div>
    </div>
</div>