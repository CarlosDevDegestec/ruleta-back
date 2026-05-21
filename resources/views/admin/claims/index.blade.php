@extends('layouts.admin')
@section('title','Reclamaciones')
@section('page-title','Reclamaciones')
@section('content')
<div class="page-header"><h2>Reclamaciones</h2></div>
<div class="card">
  <table>
    <thead><tr><th>Fecha</th><th>Premio</th><th>Rareza</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Notif.</th></tr></thead>
    <tbody>
      @forelse($claims as $claim)
      <tr>
        <td style="color:var(--muted);white-space:nowrap">{{ $claim->created_at->format('d/m/Y H:i') }}</td>
        <td><strong>{{ $claim->prize->name ?? '—' }}</strong></td>
        <td>
          @if($claim->prize)
          <span class="badge" style="background:{{ $claim->prize->rarity_color }}">{{ $claim->prize->rarity_label }}</span>
          @endif
        </td>
        <td>{{ $claim->name }}</td>
        <td>{{ $claim->email }}</td>
        <td>{{ $claim->phone }}</td>
        <td>{{ $claim->notifications ? '✅' : '—' }}</td>
      </tr>
      @empty
      <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:32px">No hay reclamaciones aún.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection