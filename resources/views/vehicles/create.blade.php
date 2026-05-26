@extends('layouts.app')
@section('title', 'Tambah Kendaraan')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🚗 Tambah Kendaraan</div>
    <div class="page-sub">Daftarkan kendaraan baru</div>
  </div>
  <a href="{{ route('vehicles.index') }}" class="btn-secondary">← Kembali</a>
</div>
 
<div class="form-card" style="max-width:640px;">
  <form method="POST" action="{{ route('vehicles.store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Nama Kendaraan *</label>
        <input type="text" name="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}"
               value="{{ old('name') }}" placeholder="Honda Civic / Scoopy" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Merek *</label>
        <input type="text" name="brand" class="form-input {{ $errors->has('brand') ? 'error' : '' }}"
               value="{{ old('brand') }}" placeholder="Honda / Toyota" required>
        @error('brand')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Model *</label>
        <input type="text" name="model" class="form-input {{ $errors->has('model') ? 'error' : '' }}"
               value="{{ old('model') }}" placeholder="Motor/Mobil" required>
        @error('model')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Tahun *</label>
        <input type="number" name="year" class="form-input {{ $errors->has('year') ? 'error' : '' }}"
               value="{{ old('year') }}" placeholder="2022" min="1990" max="{{ date('Y') }}" required>
        @error('year')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Nomor Polisi *</label>
        <input type="text" name="plate_number" class="form-input {{ $errors->has('plate_number') ? 'error' : '' }}"
               value="{{ old('plate_number') }}" placeholder="AB 1234 CD" required>
        @error('plate_number')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Bahan Bakar *</label>
        <select name="fuel_type" class="form-input" required>
          <option value="">Pilih BBM</option>
          <option value="bensin" {{ old('fuel_type')=='bensin' ? 'selected' : '' }}>Bensin</option>
          <option value="diesel" {{ old('fuel_type')=='diesel' ? 'selected' : '' }}>Diesel</option>
          <option value="listrik" {{ old('fuel_type')=='listrik' ? 'selected' : '' }}>Listrik</option>
          <option value="hybrid" {{ old('fuel_type')=='hybrid' ? 'selected' : '' }}>Hybrid</option>
        </select>
        @error('fuel_type')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Kilometer Saat Ini *</label>
      <input type="number" name="current_km" class="form-input {{ $errors->has('current_km') ? 'error' : '' }}"
             value="{{ old('current_km', 0) }}" placeholder="45000" min="0" required>
      @error('current_km')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div style="display:flex;gap:10px;margin-top:8px;">
      <button type="submit" class="btn-primary">💾 Simpan Kendaraan</button>
      <a href="{{ route('vehicles.index') }}" class="btn-secondary">Batal</a>
    </div>
  </form>
</div>
@endsection