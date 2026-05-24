@extends('layouts.app')
@section('title', 'Tambah Reminder')
 
@section('content')
<div class="page-header">
  <div><div class="page-title">🔔 Tambah Reminder</div></div>
  <a href="{{ route('reminders.index') }}" class="btn-secondary">← Kembali</a>
</div>
<div class="form-card" style="max-width:540px;">
  <form method="POST" action="{{ route('reminders.store') }}">
    @csrf
    <div class="form-group">
      <label class="form-label">Kendaraan *</label>
      <select name="vehicle_id" class="form-input" required>
        <option value="">Pilih Kendaraan</option>
        @foreach($vehicles as $v)
          <option value="{{ $v->id }}" {{ old('vehicle_id')==$v->id ? 'selected' : '' }}>{{ $v->name }}</option>
        @endforeach
      </select>
      @error('vehicle_id')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label class="form-label">Judul Reminder *</label>
      <input type="text" name="title" class="form-input" value="{{ old('title') }}" placeholder="Ganti Oli Mesin" required>
      @error('title')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-group">
      <label class="form-label">Deskripsi</label>
      <textarea name="description" class="form-input" placeholder="Catatan tambahan...">{{ old('description') }}</textarea>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Tanggal Reminder *</label>
        <input type="date" name="remind_date" class="form-input" value="{{ old('remind_date') }}" required>
        @error('remind_date')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Prioritas *</label>
        <select name="priority" class="form-input" required>
          <option value="low" {{ old('priority')=='low' ? 'selected' : '' }}>🟢 Low</option>
          <option value="medium" {{ old('priority','medium')=='medium' ? 'selected' : '' }}>🟡 Medium</option>
          <option value="high" {{ old('priority')=='high' ? 'selected' : '' }}>🔴 High</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn-primary">💾 Simpan Reminder</button>
  </form>
</div>
@endsection