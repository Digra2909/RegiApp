@extends('layouts.main')
@section('titre', 'Modifier utilisateur')

@section('content')
<div class="dashboard-wrapper px-4 py-4">
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1">Modifier : {{ $user->name }}</h3>
                <p class="text-muted small">Gestion des privilèges de l'utilisateur.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4 p-3 shadow-sm d-flex align-items-center" role="alert" style="background-color: #f0fdf4; color: #166534;">
                    <i class="bi bi-check2-all me-2.5 fs-5"></i>
                    <div class="fw-medium small">{{ session('success') }}</div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" style="padding: 1.25rem; font-size: 0.75rem;"></button>
                </div>
            @endif
            <div class="card custom-card p-4">
                <form action="{{ route('settings.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom mb-3">Attribution des Rôles</label>
                            @foreach($roles as $role)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role->id }}">{{ ucfirst($role->name) }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label-custom mb-3">Permissions Spécifiques</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-6">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm_{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <hr class="text-muted my-3">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-submit-custom px-4">Enregistrer les changements</button>
                        <a href="{{ route('settings.users.index') }}" class="btn btn-outline-secondary btn-submit-custom px-4">Retour</a>
                    </div>
                </form>
            </div>
</div>
@endsection