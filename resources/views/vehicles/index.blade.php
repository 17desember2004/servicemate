@extends('layouts.app')
@section('title', 'My Vehicles')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🚗 My Vehicles</div>
    <div class="page-sub">Kelola semua kendaraanmu</div>
  </div>
  <a href="{{ route('vehicles.create') }}" class="btn-primary">+ Tambah Kendaraan</a>
</div>
 
@if($vehicles->isEmpty())
  <div class="empty">
    <div class="empty-icon">🚗</div>
    <div class="empty-title">Belum ada kendaraan</div>
    <div class="empty-sub">Tambahkan kendaraan pertamamu sekarang!</div>
    <a href="{{ route('vehicles.create') }}" class="btn-primary">+ Tambah Kendaraan</a>
  </div>
@else
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
    @foreach($vehicles as $v)
    <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:16px;padding:22px;transition:box-shadow .2s;" onmouseover="this.style.boxShadow='0 8px 24px rgba(15,23,42,0.1)'" onmouseout="this.style.boxShadow='none'">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px;">
        <div>
          <div style="font-size:1.05rem;font-weight:800;color:#0f172a;">{{ $v->name }}</div>
          <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">{{ $v->year }} · {{ $v->plate_number }}</div>
        </div>
        <span class="badge {{ $v->status=='active' ? 'badge-green' : 'badge-gray' }}">
          {{ $v->status=='active' ? 'Aktif' : 'Nonaktif' }}
        </span>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
        <div style="background:#f8fafc;border-radius:10px;padding:10px;">
          <div style="font-size:0.7rem;color:#64748b;margin-bottom:3px;">KM Saat Ini</div>
          <div style="font-size:1rem;font-weight:700;color:#0f172a;">{{ number_format($v->current_km) }}</div>
        </div>
        <div style="background:#f8fafc;border-radius:10px;padding:10px;">
          <div style="font-size:0.7rem;color:#64748b;margin-bottom:3px;">Bahan Bakar</div>
          <div style="font-size:1rem;font-weight:700;color:#0f172a;text-transform:capitalize;">{{ $v->fuel_type }}</div>
        </div>
      </div>
      <div style="display:flex;gap:8px;">
        <a href="{{ route('vehicles.show', $v) }}" class="btn-secondary" style="flex:1;justify-content:center;">Detail</a>
        <a href="{{ route('vehicles.edit', $v) }}" class="btn-primary" style="flex:1;justify-content:center;">Edit</a>
        <form method="POST" action="{{ route('vehicles.destroy', $v) }}" onsubmit="return confirm('Hapus kendaraan ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn-danger">🗑</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
@endif
@endsection