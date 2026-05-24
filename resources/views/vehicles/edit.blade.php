@extends('layouts.app')
@section('title', 'Edit Kendaraan')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">✏️ Edit Kendaraan</div>
    <div class="page-sub">{{ $vehicle->name }}</div>
  </div>
  <a href="{{ route('vehicles.index') }}" class="btn-secondary">← Kembali</a>
</div>
 
<div class="form-card" style="max-width:640px;">
  <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
    @csrf @method('PUT')
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Nama Kendaraan *</label>
        <input type="text" name="name" class="form-input" value="{{ old('name', $vehicle->name) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Merek *</label>
        <input type="text" name="brand" class="form-input" value="{{ old('brand', $vehicle->brand) }}" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Model *</label>
        <input type="text" name="model" class="form-input" value="{{ old('model', $vehicle->model) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Tahun *</label>
        <input type="number" name="year" class="form-input" value="{{ old('year', $vehicle->year) }}" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Nomor Polisi *</label>
        <input type="text" name="plate_number" class="form-input" value="{{ old('plate_number', $vehicle->plate_number) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Bahan Bakar *</label>
        <select name="fuel_type" class="form-input" required>
          @foreach(['bensin','diesel','listrik','hybrid'] as $ft)
            <option value="{{ $ft }}" {{ old('fuel_type',$vehicle->fuel_type)==$ft ? 'selected' : '' }}>{{ ucfirst($ft) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Kilometer Saat Ini *</label>
        <input type="number" name="current_km" class="form-input" value="{{ old('current_km', $vehicle->current_km) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">Status</label>
        <select name="status" class="form-input">
          <option value="active" {{ $vehicle->status=='active' ? 'selected' : '' }}>Aktif</option>
          <option value="inactive" {{ $vehicle->status=='inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>
    </div>
    <div style="display:flex;gap:10px;margin-top:8px;">
      <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
      <a href="{{ route('vehicles.index') }}" class="btn-secondary">Batal</a>
    </div>
  </form>
</div>
@endsection