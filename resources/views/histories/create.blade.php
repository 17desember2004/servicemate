@extends('layouts.app')
@section('title', 'Catat Servis')
 
@section('content')
<div class="page-header">
  <div><div class="page-title">📋 Catat Riwayat Servis</div></div>
  <a href="{{ route('histories.index') }}" class="btn-secondary">← Kembali</a>
</div>
<div class="form-card" style="max-width:600px;">
  <form method="POST" action="{{ route('histories.store') }}">
    @csrf
    <div class="form-group">
      <label class="form-label">Kendaraan *</label>
      <select name="vehicle_id" class="form-input" required>
        <option value="">Pilih Kendaraan</option>
        @foreach($vehicles as $v)
          <option value="{{ $v->id }}" {{ old('vehicle_id')==$v->id ? 'selected' : '' }}>{{ $v->name }} ({{ $v->plate_number }})</option>
        @endforeach
      </select>
      @error('vehicle_id')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label class="form-label">Jenis Servis *</label>
      <input type="text" name="service_type" class="form-input" value="{{ old('service_type') }}" placeholder="Ganti Oli, Tune Up, dll" required>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Tanggal Servis *</label>
        <input type="date" name="service_date" class="form-input" value="{{ old('service_date', date('Y-m-d')) }}" required>
      </div>
      <div class="form-group">
        <label class="form-label">KM Saat Servis *</label>
        <input type="number" name="km_at_service" class="form-input" value="{{ old('km_at_service') }}" placeholder="45000" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Biaya (Rp)</label>
        <input type="number" name="cost" class="form-input" value="{{ old('cost') }}" placeholder="150000">
      </div>
      <div class="form-group">
        <label class="form-label">Nama Bengkel</label>
        <input type="text" name="bengkel_name" class="form-input" value="{{ old('bengkel_name') }}" placeholder="Bengkel ABC">
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Catatan</label>
      <textarea name="notes" class="form-input" placeholder="Catatan servis...">{{ old('notes') }}</textarea>
    </div>
    <button type="submit" class="btn-primary">💾 Simpan Riwayat</button>
  </form>
</div>
@endsection