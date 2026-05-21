@extends('layouts.admin')
@section('title','Premios')
@section('page-title','Premios')
@section('content')
<div class="page-header">
  <h2>Premios</h2>
  <a href="{{ route('admin.prizes.create') }}" class="btn btn-primary">+ Nuevo Premio</a>
</div>
<div class="card">
  <table>
    <thead>
      <tr>
        <th>Nombre</th><th>Rareza</th><th>Peso</th><th>Probabilidad</th><th>Estado</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($prizes as $prize)
      <tr>
        <td><strong>{{ $prize->name }}</strong></td>
        <td>
          <span class="badge" style="background:{{ $prize->rarity_color }}">{{ $prize->rarity_label }}</span>
        </td>
        <td>{{ $prize->weight }}</td>
        <td>
          @if($totalWeight > 0)
            {{ number_format(($prize->weight / $totalWeight) * 100, 1) }}%
          @else
            0%
          @endif
        </td>
        <td>
          @if($prize->is_active)
            <span class="badge badge-active">Activo</span>
          @else
            <span class="badge badge-inactive">Inactivo</span>
          @endif
        </td>
        <td>
          <div class="actions-cell">
            <a href="{{ route('admin.prizes.edit', $prize) }}" class="btn-edit">Editar</a>
            <form method="POST" action="{{ route('admin.prizes.destroy', $prize) }}" onsubmit="return confirm('¿Eliminar este premio?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn-danger">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:32px">No hay premios registrados.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection