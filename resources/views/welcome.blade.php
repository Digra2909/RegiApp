@extends('layouts.main')
@section('titre', 'RegiApp || Accueil')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card border border-light-subtle shadow-lg text-center p-5 rounded-0 bg-white" style="max-width: 550px;">
        
        <div class="mb-4 position-relative">
            <img src="{{ asset('logos/logoRegidesi.png') }}" alt="Logo REGIDESO" class="img-fluid rounded-0" style="max-height: 130px;">
        </div>
        
        <h1 class="h3 text-primary fw-bold mb-2 tracking-wide">
            Bienvenue sur RegiApp
        </h1>
        
        <div class="d-flex justify-content-center mb-4">
            <hr class="border-primary border-2 opacity-50 w-25 my-0">
        </div>
        
        <p class="text-secondary mb-4 px-3 small">
            Votre plateforme centralisée pour la gestion technique et le suivi des Equipements.
        </p>

        <div class="row g-2 mb-5 text-start justify-content-center">
            <div class="col-6">
                <div class="p-3 border border-light-subtle bg-light d-flex align-items-center">
                    <i class="bi bi-diagram-3-fill text-primary fs-4 me-3"></i>
                    <div>
                        <small class="text-muted d-block font-monospace" style="font-size: 10px;">Simple</small>
                        <span class="fw-bold small text-dark">Naviquez simplement</span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="p-3 border border-light-subtle bg-light d-flex align-items-center">
                    <i class="bi bi-cpu-fill text-info fs-4 me-3"></i>
                    <div>
                        <small class="text-muted d-block font-monospace" style="font-size: 10px;">Efficacement</small>
                        <span class="fw-bold small text-dark">Gérez efficacement</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-grid px-2">
            <a href="{{ route('Entite.create') }}" class="btn btn-primary btn-lg rounded-0 py-3 fw-semibold shadow-sm text-uppercase tracking-wider small d-flex align-items-center justify-content-center gap-2">
                Entrer dans l'application 
                <i class="bi bi-arrow-right-circle fs-5"></i>
            </a>
        </div>

        <div class="mt-4 pt-2 border-top border-light-subtle">
            <small class="text-muted font-monospace" style="font-size: 11px;">REGIDESO &copy; 2026</small>
        </div>

    </div>
</div>

@endsection