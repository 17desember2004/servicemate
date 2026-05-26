@extends('layouts.app')
@section('title', 'Dashboard')
 
@section('content')
<div class="page-header" style="flex-wrap:wrap;gap:10px;">
  <div style="flex:1;min-width:0;">
    <div class="page-title">👋 Halo, {{ auth()->user()->name }}!</div>
    <div class="page-sub">Selamat datang kembali di ServiceMate</div>
  </div>
  <a href="{{ route('vehicles.create') }}" class="btn-primary" style="flex-shrink:0;">+ Tambah Kendaraan</a>
</div>
 
{{-- Stats --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue">🚗</div>
    <div class="stat-val">{{ $vehicles->count() }}</div>
    <div class="stat-lbl">Total Kendaraan</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">✅</div>
    <div class="stat-val">{{ $vehicles->where('status','active')->count() }}</div>
    <div class="stat-lbl">Kendaraan Aktif</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon orange">🔔</div>
    <div class="stat-val">{{ $reminders->count() }}</div>
    <div class="stat-lbl">Reminder Aktif</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon red">⚠️</div>
    <div class="stat-val">{{ $overdueSchedules }}</div>
    <div class="stat-lbl">Jadwal Overdue</div>
  </div>
</div>
 
{{-- Grid: Kendaraan + Reminder --}}
<div class="dash-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
 
  {{-- Kendaraan --}}
  <div>
    <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:14px;">🚗 Kendaraanmu</div>
    @forelse($vehicles as $v)
      <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:16px;margin-bottom:12px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
          <span style="font-weight:700;font-size:0.95rem;">{{ $v->name }}</span>
          <span class="badge {{ $v->status=='active' ? 'badge-green' : 'badge-gray' }}">
            {{ $v->status=='active' ? 'Aktif' : 'Nonaktif' }}
          </span>
        </div>
        <div style="font-size:0.8rem;color:#64748b;margin-bottom:10px;">{{ $v->plate_number }} · {{ number_format($v->current_km) }} km</div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
          <a href="{{ route('vehicles.show', $v) }}" class="btn-secondary" style="font-size:0.78rem;padding:6px 12px;">Detail</a>
          <a href="{{ route('schedules.create') }}?vehicle_id={{ $v->id }}" class="btn-primary" style="font-size:0.78rem;padding:6px 12px;">+ Jadwal</a>
        </div>
      </div>
    @empty
      <div class="empty">
        <div class="empty-icon">🚗</div>
        <div class="empty-title">Belum ada kendaraan</div>
        <div class="empty-sub">Tambahkan kendaraanmu sekarang</div>
        <a href="{{ route('vehicles.create') }}" class="btn-primary">+ Tambah Kendaraan</a>
      </div>
    @endforelse
  </div>
 
  {{-- Reminders --}}
  <div>
    <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:14px;">🔔 Reminder Terdekat</div>
    @forelse($reminders as $r)
      <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;padding:14px;margin-bottom:10px;display:flex;align-items:flex-start;gap:10px;">
        <div style="width:10px;height:10px;border-radius:50%;flex-shrink:0;margin-top:4px;background:{{ $r->priority=='high' ? '#ef4444' : ($r->priority=='medium' ? '#f59e0b' : '#22c55e') }};box-shadow:0 0 6px {{ $r->priority=='high' ? '#ef444480' : ($r->priority=='medium' ? '#f59e0b80' : '#22c55e80') }}"></div>
        <div style="flex:1;min-width:0;">
          <div style="font-size:0.85rem;font-weight:600;color:#0f172a;word-break:break-word;">{{ $r->title }}</div>
          <div style="font-size:0.75rem;color:#64748b;margin-top:2px;">{{ $r->vehicle->name ?? '-' }} · {{ \Carbon\Carbon::parse($r->remind_date)->diffForHumans() }}</div>
        </div>
        <form method="POST" action="{{ route('reminders.read', $r->id) }}" style="flex-shrink:0;">
          @csrf @method('PATCH')
          <button type="submit" style="background:none;border:none;cursor:pointer;font-size:0.75rem;color:#2563eb;font-weight:600;white-space:nowrap;">✓ Baca</button>
        </form>
      </div>
    @empty
      <div class="empty">
        <div class="empty-icon">🔔</div>
        <div class="empty-title">Tidak ada reminder</div>
        <div class="empty-sub">Semua jadwal aman!</div>
      </div>
    @endforelse
    <a href="{{ route('reminders.index') }}" style="font-size:0.82rem;color:#2563eb;text-decoration:none;font-weight:600;">Lihat semua reminder →</a>
  </div>
 
</div>
 
@push('styles')
<style>
  @media(max-width:768px){
    .dash-grid{
      grid-template-columns:1fr !important;
    }
  }
</style>
@endpush
@endsection

