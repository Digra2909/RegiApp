<!-- Desktop Sidebar -->
<aside class="sidebar sidebar-desktop">
    <div class="sidebar-brand">
        <img src="{{ asset('logos/logoRegidesi.png') }}" alt="REGIDESO S.A." class="sidebar-logo">
        <div class="sidebar-brand-text">
            <h5 class="sidebar-title">RegiApp</h5>
            <small class="sidebar-subtitle">REGIDESO S.A.</small>
        </div>
    </div>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">
            <i class="bi bi-folder2-open me-2"></i> DRK-E
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('Equipement.index') }}"
                   class="sidebar-link {{ request()->routeIs('Equipement.index') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            @hasanyrole('admin|operateur')
            <li>
                <a href="{{ route('global') }}"
                   class="sidebar-link {{ request()->routeIs('global') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard global</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Direction.create') }}"
                   class="sidebar-link {{ request()->routeIs('Direction.*') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Gérer les directions</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Entite.create') }}"
                   class="sidebar-link {{ request()->routeIs('Entite.*') ? 'active' : '' }}">
                    <i class="bi bi-layers"></i>
                    <span>Gérer les bureaux</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Poste.create') }}"
                   class="sidebar-link {{ request()->routeIs('Poste.*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt"></i>
                    <span>Gérer les postes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Equipement.create') }}"
                   class="sidebar-link {{ request()->routeIs('Equipement.create') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Gérer les équipements</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.users.index') }}"
                   class="sidebar-link {{ request()->routeIs('settings.users.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i>
                    <span>Paramètres</span>
                </a>
            </li>
            @endhasanyrole
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('profile.edit') }}" class="sidebar-btn sidebar-btn-primary">
            <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
        </a>
        <form action="{{ route('logout') }}" method="post" class="m-0">
            @csrf
            <button type="submit" class="sidebar-btn sidebar-btn-danger">
                <i class="bi bi-power me-2"></i> Déconnexion
            </button>
        </form>
        <div class="sidebar-copyright">
            <p>Suivi d'infrastructure matériel</p>
            <span>&copy; gradidev026 &bull; Tous droits réservés</span>
        </div>
    </div>
</aside>

<!-- Offcanvas Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('logos/logoRegidesi.png') }}" alt="REGIDESO" class="offcanvas-logo">
            <div>
                <div class="fw-bold text-white">RegiApp</div>
                <small class="text-white-50">REGIDESO S.A.</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column">
        <nav class="offcanvas-nav">
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('Equipement.index') }}"
                       class="sidebar-link {{ request()->routeIs('Equipement.index') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                @hasanyrole('admin|operateur')
                <li>
                    <a href="{{ route('global') }}"
                       class="sidebar-link {{ request()->routeIs('global') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard global</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Direction.create') }}"
                       class="sidebar-link {{ request()->routeIs('Direction.*') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle"></i>
                        <span>Gérer les directions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Entite.create') }}"
                       class="sidebar-link {{ request()->routeIs('Entite.*') ? 'active' : '' }}">
                        <i class="bi bi-layers"></i>
                        <span>Gérer les bureaux</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Poste.create') }}"
                       class="sidebar-link {{ request()->routeIs('Poste.*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt"></i>
                        <span>Gérer les postes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Equipement.create') }}"
                       class="sidebar-link {{ request()->routeIs('Equipement.create') ? 'active' : '' }}">
                        <i class="bi bi-tools"></i>
                        <span>Gérer les équipements</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.users.index') }}"
                       class="sidebar-link {{ request()->routeIs('settings.users.*') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                @endhasanyrole
            </ul>
        </nav>

        <div class="offcanvas-footer">
            <a href="{{ route('profile.edit') }}" class="sidebar-btn sidebar-btn-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i> Connexion
            </a>
            <form action="{{ route('logout') }}" method="post" class="m-0">
                @csrf
                <button type="submit" class="sidebar-btn sidebar-btn-danger">
                    <i class="bi bi-power me-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>
</div>
