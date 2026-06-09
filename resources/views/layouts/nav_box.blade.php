<nav class="col-md-2 d-none d-md-block sidebar position-fixed p-4 d-flex flex-column vh-100 bg-dark  text-light rounded-0 border-0">
    
    <div class="text-center  py-3">
        <img src="{{ asset('logos/logoRegidesi.png') }}" alt="Logo App" class="img-fluid rounded-0" style="max-width: 100px;">
        <h5 class="mt-2 text-white fw-bold" style="font-size: 1.1rem;">RegiApp</h5>
        
    </div>
    <hr class="text-white border-top border-2 opacity-50">

    <ul class="nav flex-column mb-auto">
        
        <li class="nav-item dropdown mt-3">
            <a class="nav-link dropdown-toggle bg-info mb-2 text-center text-white" href="#" data-bs-toggle="dropdown">DDK - EST</a>
            <ul class="dropdown-menu w-100 rounded-0 border-0 shadow-sm">
                <li><a class="dropdown-item" href="{{ route('Entite.create') }}">Gerer les entités</a></li>
                <li><a class="dropdown-item" href="{{ route('Poste.create') }}">Gerer les Postes</a></li>
                <li><a class="dropdown-item" href="{{ route('Equipement.create') }}">Gerer les équipements</a></li>
            </ul>
        </li>
    </ul>

    <div class="mt-auto">
        <a href="/login" class="btn btn-light w-100 mb-2 rounded-0 text-dark fw-bold">
            <i class="bi bi-box-arrow-in-right"></i> Connexion
        </a>
        
        <form action="" method="post">
            @csrf
            <button type="submit"  class="btn btn-outline-light w-100 mb-4 rounded-0">
                <i class="bi bi-power"></i> Déconnexion
            </button>
        </form>

        <div class="text-center">
            <small class="text-white-50" style="font-size: 0.7rem;">&copy; gradidev026 copyright tous droits réservés</small>
        </div>
        <p class="text-right">
            Application de gestion des équipements de la Regigeso DDK
        </p>
    </div>
</nav>