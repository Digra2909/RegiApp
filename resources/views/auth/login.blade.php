<x-guest-layout>
    <div class="container-fluid p-0 h-100">
        <div class="row g-0 h-100">
            <div class="col-md-6 d-none d-md-flex split-image">
                <h1 class="main-title">Gestion Parc & Équipements</h1>
                <p class="sub-text">Solution de monitoring et maintenance technique intégrée pour les infrastructures de la REGIDESO.</p>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
                <div class="login-card w-100" style="max-width: 400px;">
                    
                    <div class="text-center mb-4">
                        <x-application-logo class="w-25 h-25" />
                    </div>

                    <h3 class="mb-4 fw-bold text-center">Connexion</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <x-text-input class="form-control form-control-lg" type="email" name="email" :value="old('email')" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Mot de passe</label>
                            <x-text-input class="form-control form-control-lg" type="password" name="password" required />
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-3 shadow-sm">
                            Se connecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>