@extends('layouts.app')
@section('title', 'Reminders')
 
@section('content')
<div class="page-header">
  <div><div class="page-title">🔔 Reminders</div><div class="page-sub">Pengingat perawatan kendaraan</div></div>
  <a href="{{ route('reminders.create') }}" class="btn-primary">+ Tambah Reminder</a>
</div>
 
@if($reminders->isEmpty())
  <div class="empty"><div class="empty-icon">🔔</div><div class="empty-title">Belum ada reminder</div><a href="{{ route('reminders.create') }}" class="btn-primary">+ Tambah Reminder</a></div>
@else
<div style="display:flex;flex-direction:column;gap:12px;">
  @foreach($reminders as $r)
  <div style="background:#fff;border:1.5px solid {{ $r->is_read ? '#e2e8f0' : '#bfdbfe' }};border-radius:14px;padding:18px;display:flex;align-items:center;gap:14px;opacity:{{ $r->is_read ? '0.7' : '1' }}">
    <div style="width:12px;height:12px;border-radius:50%;flex-shrink:0;background:{{ $r->priority=='high' ? '#ef4444' : ($r->priority=='medium' ? '#f59e0b' : '#22c55e') }}"></div>
    <div style="flex:1;">
      <div style="font-weight:700;font-size:0.95rem;color:#0f172a;">{{ $r->title }}</div>
      <div style="font-size:0.8rem;color:#64748b;margin-top:3px;">{{ $r->vehicle->name ?? '-' }} · {{ \Carbon\Carbon::parse($r->remind_date)->format('d M Y') }}</div>
      @if($r->description)<div style="font-size:0.82rem;color:#64748b;margin-top:4px;">{{ $r->description }}</div>@endif
    </div>
    <span class="badge {{ $r->priority=='high' ? 'badge-red' : ($r->priority=='medium' ? 'badge-yellow' : 'badge-green') }}">{{ ucfirst($r->priority) }}</span>
    @if(!$r->is_read)
    <form method="POST" action="{{ route('reminders.read', $r->id) }}">
      @csrf @method('PATCH')
      <button type="submit" class="btn-secondary" style="padding:6px 12px;font-size:0.78rem;">✓ Baca</button>
    </form>
    @else
      <span class="badge badge-gray">Dibaca</span>
    @endif
    <form method="POST" action="{{ route('reminders.destroy', $r) }}" onsubmit="return confirm('Hapus?')">
      @csrf @method('DELETE')
      <button type="submit" class="btn-danger">🗑</button>
    </form>
  </div>
  @endforeach
</div>
@endif
@endsection