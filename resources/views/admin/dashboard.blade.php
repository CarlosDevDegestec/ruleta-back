@extends('layouts.admin')
@section('title','Dashboard')
@section('page-title','Dashboard')
@section('content')
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-label">Total Premios</div>
    <div class="stat-value">{{ $totalPrizes }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Preguntas</div>
    <div class="stat-value">{{ $totalQuestions }}</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Reclamaciones</div>
    <div class="stat-value">{{ $totalClaims }}</div>
  </div>
</div>
<div class="card">
  <p style="color:var(--muted);font-size:.9rem">Bienvenido al panel de administración de la Ruleta de Premios. Usa el menú lateral para gestionar premios, preguntas y reclamaciones.</p>
</div>
@endsection