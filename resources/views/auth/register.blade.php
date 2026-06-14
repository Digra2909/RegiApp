<x-guest-layout>
    <div class="container-fluid p-0 h-100">
        <div class="row g-0 h-100">
            <div class="col-md-6 d-none d-md-flex split-image">
                <h1 class="main-title">Gestion Parc & Équipements</h1>
                <p class="sub-text">Solution de monitoring et maintenance technique intégrée pour les infrastructures de la REGIDESO.</p>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
                <div class="login-card w-100" style="max-width: 450px;">
                    
                    <div class="text-center mb-4">
                        <x-application-logo class="w-25 h-25" />
                    </div>

                    <h3 class="mb-4 fw-bold text-center">Créer un compte</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-muted">Nom complet</label>
                            <x-text-input id="name" class="form-control form-control-lg" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Mot de passe</label>
                            <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Confirmer le mot de passe</label>
                            <x-text-input id="password_confirmation" class="form-control form-control-lg" type="password" name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mt-1" />
                        </div>

                        <div class="d-grid mt-4">
                            <x-primary-button class="btn btn-primary btn-lg shadow-sm">
                                {{ __('S\'inscrire') }}
                            </x-primary-button>
                        </div>

                        <div class="text-center mt-3">
                            <a class="text-decoration-none small text-muted" href="{{ route('login') }}">
                                {{ __('Déjà inscrit ? Connectez-vous') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>