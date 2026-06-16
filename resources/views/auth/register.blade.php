@extends('layouts.main')
@section('titre', 'Nouvel utilisateur')

@section('content')
<div class="container-fluid dashboard-wrapper min-vh-100 p-0">
    <div class="row g-0">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-0 menu-sidebar border-end" style="background: #0f172a;">
            @include('layouts.nav_box')
        </div>

        <!-- Contenu Principal -->
        <div class="col-md-9 col-lg-10 px-4 py-4">
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1">Créer un nouvel utilisateur</h3>
                <p class="text-muted small">Remplissez les informations et définissez les accès.</p>
            </div>

            <div class="card custom-card p-4">
                <form method="POST" action="{{ $formAction ?? route('register') }}">
                    @csrf
                    
                    <div class="row g-4">
                        <!-- Informations de base -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label form-label-custom">Nom complet</label>
                                <input type="text" name="name" class="form-control form-control-custom" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label form-label-custom">Email</label>
                                <input type="email" name="email" class="form-control form-control-custom" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label form-label-custom">Mot de passe</label>
                                <input type="password" name="password" class="form-control form-control-custom" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label form-label-custom">Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-custom" required>
                            </div>
                        </div>

                        <!-- Rôles et Permissions -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label form-label-custom mb-3">Attribuer des Rôles</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($roles as $role)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}">
                                            <label class="form-check-label" for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Permissions removed: roles include required permissions -->
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-submit-custom px-4">Créer l'utilisateur</button>
                        <a href="{{ route('settings.users.index') }}" class="btn btn-outline-secondary btn-submit-custom px-4 ms-2">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection