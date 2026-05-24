@extends('layouts.app')
@section('title', 'Schedule')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">📅 Schedule Servis</div>
    <div class="page-sub">Jadwal perawatan semua kendaraan</div>
  </div>
  <a href="{{ route('schedules.create') }}" class="btn-primary">+ Tambah Jadwal</a>
</div>
 
@if($schedules->isEmpty())
  <div class="empty">
    <div class="empty-icon">📅</div>
    <div class="empty-title">Belum ada jadwal servis</div>
    <div class="empty-sub">Tambahkan jadwal servis pertama kendaraanmu</div>
    <a href="{{ route('schedules.create') }}" class="btn-primary">+ Tambah Jadwal</a>
  </div>
@else
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>Kendaraan</th>
        <th>Jenis Servis</th>
        <th>Tanggal & Jam</th>
        <th>KM Due</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($schedules as $s)
    <tr>
      <td><span style="font-weight:600;">{{ $s->vehicle->name ?? '-' }}</span><br>
          <span style="font-size:0.75rem;color:#94a3b8;">{{ $s->vehicle->plate_number ?? '' }}</span>
      </td>
      <td>{{ $s->service_type }}
        @if($s->notes)
          <br><span style="font-size:0.75rem;color:#94a3b8;">📝 {{ Str::limit($s->notes, 40) }}</span>
        @endif
      </td>
      <td>
        @if($s->due_date)
          {{ \Carbon\Carbon::parse($s->due_date)->format('d M Y') }}
          @if($s->service_time)
            <br><span style="font-size:0.78rem;color:#2563eb;font-weight:600;">⏰ {{ $s->service_time }} WIB</span>
          @endif
        @else
          <span style="color:#94a3b8;">-</span>
        @endif
      </td>
      <td>{{ $s->due_km ? number_format($s->due_km).' km' : '-' }}</td>
      <td>
        <span class="badge {{ $s->status=='done' ? 'badge-green' : ($s->status=='overdue' ? 'badge-red' : 'badge-yellow') }}">
          {{ $s->status=='done' ? '✅ Selesai' : ($s->status=='overdue' ? '🔴 Overdue' : '🟡 Upcoming') }}
        </span>
      </td>
      <td>
        <div style="display:flex;gap:6px;">
          <a href="{{ route('schedules.edit', $s) }}" class="btn-secondary" style="padding:6px 12px;font-size:0.78rem;">✏️ Edit</a>
          <form method="POST" action="{{ route('schedules.destroy', $s) }}" onsubmit="return confirm('Hapus jadwal ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger">🗑</button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection