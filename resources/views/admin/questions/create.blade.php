@extends('layouts.admin')
@section('title','Nueva Pregunta')
@section('page-title','Nueva Pregunta')
@section('content')
<div class="page-header"><h2>Nueva Pregunta</h2></div>
<div class="card max-w">
@if(isset($question))
  <form method="POST" action="{{ route('admin.questions.update', $question) }}">
    @csrf @method('PUT')
@else
  <form method="POST" action="{{ route('admin.questions.store') }}">
    @csrf
@endif
  <div class="form-group">
    <label>Texto de la Pregunta</label>
    <textarea name="question" rows="3" required placeholder="Ej: ¿Cómo calificarías tu experiencia?">{{ old('question', $question->question ?? '') }}</textarea>
  </div>
  <div class="form-group">
    <label>Tipo de Respuesta</label>
    <select name="type" required>
      <option value="rating" {{ old('type', $question->type ?? '') == 'rating' ? 'selected' : '' }}>Rating (Estrellas)</option>
      <option value="text" {{ old('type', $question->type ?? '') == 'text' ? 'selected' : '' }}>Texto libre</option>
    </select>
  </div>
  <div class="form-group">
    <label>Orden</label>
    <input type="number" name="order" value="{{ old('order', $question->order ?? 0) }}" min="0" max="255" required>
    <p class="form-hint">Las preguntas se muestran ordenadas por este valor (menor = primero).</p>
  </div>
  <div class="form-group">
    <div class="checkbox-row">
      <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $question->is_active ?? true) ? 'checked' : '' }}>
      <label for="is_active" style="margin:0">Pregunta activa</label>
    </div>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">{{ isset($question) ? 'Actualizar Pregunta' : 'Crear Pregunta' }}</button>
    <a href="{{ route('admin.questions.index') }}" class="btn btn-secondary">Cancelar</a>
  </div>
</form>
</div>
@endsection