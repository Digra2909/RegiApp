@extends('layouts.main')
@section('titre', 'Paramètres Système')
@section('content')

<div class="dashboard-wrapper px-4 py-4">
            
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.4px;">Paramètres</h3>
                <p class="text-muted small mb-0">Gestion centralisée des accès utilisateurs et suivi des logs système.</p>
            </div>

            <ul class="nav nav-tabs border-0 mb-3" id="settingsTab">
                <li class="nav-item">
                    <button class="nav-link active fw-semibold text-dark" data-bs-toggle="tab" data-bs-target="#users">Utilisateurs</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-semibold text-muted" data-bs-toggle="tab" data-bs-target="#logs">Logs Système</button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="users">
                    <div class="card custom-card p-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4 pb-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div>
                                <h5 class="fw-bold text-dark mb-0">Liste des utilisateurs</h5>
                                <p class="text-muted small mb-0">Gérez les comptes et les accès système.</p>
                            </div>
                            <a href="{{ route('settings.users.create') }}" class="btn btn-primary btn-submit-custom px-3 py-2 d-flex align-items-center gap-2">
                                <i class="bi bi-plus-lg"></i>
                                <span>Nouvel utilisateur</span>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="text-muted text-uppercase small">
                                        <tr><th>Nom</th><th>Email</th><th>Rôles</th><th>Actions</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="fw-bold">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->getRoleNames() as $role)
                                                    <span class="badge bg-light text-dark border rounded-pill">{{ $role }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a href="{{ route('settings.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary border-0">Modifier</a>
                                                    <form action="{{ route('settings.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">Supprimer</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="logs">
                    <div class="card custom-card p-4 bg-dark text-light">
                        <h6 class="text-uppercase text-secondary mb-3 small fw-bold">Dernières activités</h6>
                        <div class="d-flex flex-column gap-2">
                            @forelse($activityLogs as $log)
                                <div class="small text-monospace m-0" style="color: #10b981;">
                                    [{{ $log->created_at->format('Y-m-d H:i:s') }}] {{ strtoupper($log->action) }}: @if($log->meta) {{ json_encode($log->meta) }} @endif @if($log->user) — {{ $log->user->name }} @endif
                                </div>
                            @empty
                                <div class="small text-muted">Aucune activité enregistrée.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection