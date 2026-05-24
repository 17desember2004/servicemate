@extends('layouts.app')
@section('title', 'Edit Jadwal')

@section('content')
<div class="page-header">
  <div><div class="page-title">✏️ Edit Jadwal Servis</div></div>
  <a href="{{ route('schedules.index') }}" class="btn-secondary">← Kembali</a>
</div>
<div class="form-card" style="max-width:540px;">
  <form method="POST" action="{{ route('schedules.update', $schedule) }}">
    @csrf @method('PUT')
    <div class="form-group">
      <label class="form-label">Kendaraan</label>
      <select name="vehicle_id" class="form-input" required>
        @foreach($vehicles as $v)
          <option value="{{ $v->id }}" {{ $schedule->vehicle_id==$v->id ? 'selected' : '' }}>
            {{ $v->name }} ({{ $v->plate_number }})
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label class="form-label">Jenis Servis *</label>
      <input type="text" name="service_type" class="form-input"
             value="{{ old('service_type', $schedule->service_type) }}" required>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Tanggal Due</label>
        <input type="date" name="due_date" class="form-input"
               value="{{ old('due_date', $schedule->due_date) }}">
      </div>
      <div class="form-group">
        <label class="form-label">KM Due</label>
        <input type="number" name="due_km" class="form-input"
               value="{{ old('due_km', $schedule->due_km) }}">
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Status</label>
      <select name="status" class="form-input">
        <option value="upcoming" {{ $schedule->status=='upcoming' ? 'selected' : '' }}>🟡 Upcoming</option>
        <option value="overdue"  {{ $schedule->status=='overdue'  ? 'selected' : '' }}>🔴 Overdue</option>
        <option value="done"     {{ $schedule->status=='done'     ? 'selected' : '' }}>🟢 Selesai</option>
      </select>
    </div>
    <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
  </form>
</div>
@endsection

