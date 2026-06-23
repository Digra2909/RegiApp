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
                    <div class="card custom-card p-0 shadow-sm border-0">
                        <div class="card-header bg-white border-0 pt-4 pb-2">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="bi bi-terminal me-2"></i>Dernières activités
                            </h5>
                            <p class="text-muted small mb-0">Suivi des actions enregistrées sur la plateforme.</p>
                        </div>
                        <div class="card-body p-4">
                            @forelse($activityLogs as $log)
                                <div class="d-flex align-items-start gap-3 py-2 border-bottom border-light">
                                    <div class="mt-1">
                                        <span class="badge rounded-pill px-2 py-1
                                            @switch($log->action)
                                                @case('created') bg-success-subtle text-success @break
                                                @case('updated') bg-info-subtle text-info @break
                                                @case('deleted') bg-danger-subtle text-danger @break
                                                @default bg-secondary-subtle text-secondary
                                            @endswitch
                                        " style="font-size: 0.65rem; letter-spacing: 0.3px; font-weight: 700;">
                                            {{ strtoupper($log->action) }}
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="small text-dark mb-1 text-break">
                                            @if($log->meta)
                                                <span class="fw-medium">{{ class_basename($log->meta['model'] ?? '') }}</span>
                                                @if(isset($log->meta['attributes']['designationEquipement']))
                                                    — {{ $log->meta['attributes']['designationEquipement'] }}
                                                @elseif(isset($log->meta['attributes']['designationDirection']))
                                                    — {{ $log->meta['attributes']['designationDirection'] }}
                                                @elseif(isset($log->meta['attributes']['designationEntite']))
                                                    — {{ $log->meta['attributes']['designationEntite'] }}
                                                @elseif(isset($log->meta['attributes']['designationPoste']))
                                                    — {{ $log->meta['attributes']['designationPoste'] }}
                                                @elseif(isset($log->meta['attributes']['name']))
                                                    — {{ $log->meta['attributes']['name'] }}
                                                @endif
                                            @else
                                                Action enregistrée
                                            @endif
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <span class="text-muted" style="font-size: 0.7rem;">
                                                <i class="bi bi-clock me-1"></i>{{ $log->created_at->format('d/m/Y H:i') }}
                                            </span>
                                            @if($log->user)
                                                <span class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="bi bi-person me-1"></i>{{ $log->user->name }}
                                                </span>
                                            @endif
                                            @if($log->ip)
                                                <span class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="bi bi-globe me-1"></i>{{ $log->ip }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                    <p class="text-muted small mt-2 mb-0">Aucune activité enregistrée.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection