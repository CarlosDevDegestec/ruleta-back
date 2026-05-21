@extends('layouts.admin')
@section('title','Nuevo Premio')
@section('page-title','Nuevo Premio')
@section('content')
<div class="page-header">
  <h2>Nuevo Premio</h2>
</div>
<div class="card max-w">
@if(isset($prize))
  <form method="POST" action="{{ route('admin.prizes.update', $prize) }}">
    @csrf @method('PUT')
@else
  <form method="POST" action="{{ route('admin.prizes.store') }}">
    @csrf
@endif
  <div class="form-group">
    <label>Nombre del Premio</label>
    <input type="text" name="name" value="{{ old('name', $prize->name ?? '') }}" required placeholder="Ej: Bebida Gratis">
  </div>
  <div class="form-group">
    <label>Rareza</label>
    <select name="rarity" id="raritySelect" onchange="setDefaultWeight(this.value)" required>
      <option value="">Selecciona rareza</option>
      @foreach(['comun'=>'Común','poco_comun'=>'Poco Común','raro'=>'Raro','epico'=>'Épico','legendario'=>'Legendario'] as $key => $label)
      <option value="{{ $key }}" {{ old('rarity', $prize->rarity ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Peso</label>
    <input type="number" name="weight" id="weightInput" value="{{ old('weight', $prize->weight ?? '') }}" min="1" max="100" required>
    <p class="form-hint">Mayor peso = mayor probabilidad. Se auto-rellena con el valor por defecto de la rareza.</p>
  </div>
  <div class="form-group">
    <div class="checkbox-row">
      <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $prize->is_active ?? true) ? 'checked' : '' }}>
      <label for="is_active" style="margin:0">Premio activo</label>
    </div>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">{{ isset($prize) ? 'Actualizar Premio' : 'Crear Premio' }}</button>
    <a href="{{ route('admin.prizes.index') }}" class="btn btn-secondary">Cancelar</a>
  </div>
</form>
<script>
const defaultWeights = {comun:15,poco_comun:8,raro:5,epico:3,legendario:1};
function setDefaultWeight(rarity){
  const w = document.getElementById('weightInput');
  if(!w.value || w.dataset.auto === '1') {
    w.value = defaultWeights[rarity] || '';
    w.dataset.auto = '1';
  }
}
document.getElementById('weightInput').addEventListener('input', function(){
  this.dataset.auto = '0';
});
</script>
</div>
@endsection