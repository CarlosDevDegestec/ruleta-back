@extends('layouts.admin')
@section('title','Configuración')
@section('page-title','Configuración de la Ruleta')
@section('content')
<div class="page-header"><h2>Configuración de la Ruleta</h2></div>
<div class="card max-w">
  <form method="POST" action="{{ route('admin.config.update') }}">
    @csrf @method('PUT')
    <div class="form-group">
      <label>Título Principal</label>
      <input type="text" name="title" value="{{ old('title', $config->title) }}" required placeholder="¡Gira y Gana!">
    </div>
    <div class="form-group">
      <label>Subtítulo</label>
      <input type="text" name="subtitle" value="{{ old('subtitle', $config->subtitle) }}" placeholder="Subtítulo opcional">
    </div>
    <div class="form-group">
      <div class="checkbox-row">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $config->is_active) ? 'checked' : '' }}>
        <label for="is_active" style="margin:0">Ruleta activa (desactivar oculta la ruleta en el frontend)</label>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Guardar Configuración</button>
    </div>
  </form>
</div>
@endsection