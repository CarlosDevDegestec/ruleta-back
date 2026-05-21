@extends('layouts.admin')
@section('title','Preguntas')
@section('page-title','Preguntas')
@section('content')
<div class="page-header">
  <h2>Preguntas</h2>
  <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">+ Nueva Pregunta</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>#</th><th>Pregunta</th><th>Tipo</th><th>Orden</th><th>Estado</th><th>Acciones</th></tr></thead>
    <tbody>
      @forelse($questions as $question)
      <tr>
        <td style="color:var(--muted)">{{ $question->id }}</td>
        <td>{{ $question->question }}</td>
        <td><span class="badge" style="background:{{ $question->type==='rating' ? '#0D47A1' : '#4A148C' }}">{{ $question->type === 'rating' ? 'Rating ⭐' : 'Texto 📝' }}</span></td>
        <td>{{ $question->order }}</td>
        <td>
          @if($question->is_active)<span class="badge badge-active">Activa</span>
          @else<span class="badge badge-inactive">Inactiva</span>@endif
        </td>
        <td>
          <div class="actions-cell">
            <a href="{{ route('admin.questions.edit', $question) }}" class="btn-edit">Editar</a>
            <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('¿Eliminar esta pregunta?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn-danger">Eliminar</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:32px">No hay preguntas registradas.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection