@extends('layouts.app')
@section('title', 'Detail Kendaraan')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">🚗 {{ $vehicle->name }}</div>
    <div class="page-sub">{{ $vehicle->plate_number }} · {{ $vehicle->year }}</div>
  </div>
  <div style="display:flex;gap:10px;">
    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn-primary">✏️ Edit</a>
    <a href="{{ route('vehicles.index') }}" class="btn-secondary">← Kembali</a>
  </div>
</div>
 
{{-- Info Kendaraan --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px;">
  <div class="form-card">
    <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:18px;">📋 Informasi Kendaraan</div>
    <div style="display:flex;flex-direction:column;gap:12px;">
      @foreach([
        ['Nama','name'],['Merek','brand'],['Model','model'],
        ['Tahun','year'],['Plat Nomor','plate_number'],
        ['Bahan Bakar','fuel_type'],['KM Saat Ini','current_km'],
      ] as [$label,$field])
      <div style="display:flex;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid #f1f5f9;">
        <span style="font-size:0.83rem;color:#64748b;">{{ $label }}</span>
        <span style="font-size:0.88rem;font-weight:600;color:#0f172a;">
          {{ $field=='current_km' ? number_format($vehicle->$field).' km' : ucfirst($vehicle->$field) }}
        </span>
      </div>
      @endforeach
      <div style="display:flex;justify-content:space-between;">
        <span style="font-size:0.83rem;color:#64748b;">Status</span>
        <span class="badge {{ $vehicle->status=='active' ? 'badge-green' : 'badge-gray' }}">
          {{ $vehicle->status=='active' ? 'Aktif' : 'Nonaktif' }}
        </span>
      </div>
    </div>
  </div>
 
  {{-- Quick Actions --}}
  <div style="display:flex;flex-direction:column;gap:14px;">
    <a href="{{ route('schedules.create') }}?vehicle_id={{ $vehicle->id }}"
       style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:18px;text-decoration:none;display:flex;align-items:center;gap:14px;transition:border-color .2s;"
       onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
      <div style="width:44px;height:44px;background:#dbeafe;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;">📅</div>
      <div>
        <div style="font-weight:700;font-size:0.92rem;color:#0f172a;">Tambah Jadwal Servis</div>
        <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">Atur jadwal perawatan</div>
      </div>
    </a>
    <a href="{{ route('reminders.create') }}"
       style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:18px;text-decoration:none;display:flex;align-items:center;gap:14px;transition:border-color .2s;"
       onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
      <div style="width:44px;height:44px;background:#fef9c3;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;">🔔</div>
      <div>
        <div style="font-weight:700;font-size:0.92rem;color:#0f172a;">Tambah Reminder</div>
        <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">Set pengingat servis</div>
      </div>
    </a>
    <a href="{{ route('histories.create') }}"
       style="background:#fff;border:1.5px solid #e2e8f0;border-radius:14px;padding:18px;text-decoration:none;display:flex;align-items:center;gap:14px;transition:border-color .2s;"
       onmouseover="this.style.borderColor='#2563eb'" onmouseout="this.style.borderColor='#e2e8f0'">
      <div style="width:44px;height:44px;background:#dcfce7;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;">📋</div>
      <div>
        <div style="font-weight:700;font-size:0.92rem;color:#0f172a;">Catat Riwayat Servis</div>
        <div style="font-size:0.78rem;color:#64748b;margin-top:2px;">Simpan catatan perawatan</div>
      </div>
    </a>
  </div>
</div>
 
{{-- Jadwal Servis --}}
<div style="margin-bottom:24px;">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div style="font-size:1rem;font-weight:700;color:#0f172a;">📅 Jadwal Servis</div>
    <a href="{{ route('schedules.create') }}?vehicle_id={{ $vehicle->id }}" class="btn-primary" style="font-size:0.82rem;padding:8px 14px;">+ Tambah</a>
  </div>
  @if($schedules->isEmpty())
    <div style="background:#fff;border:1.5px dashed #e2e8f0;border-radius:14px;padding:28px;text-align:center;">
      <div style="font-size:0.88rem;color:#64748b;">Belum ada jadwal servis untuk kendaraan ini</div>
    </div>
  @else
  <div class="table-wrap">
    <table>
      <thead><tr><th>Jenis Servis</th><th>Tanggal Due</th><th>KM Due</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      @foreach($schedules as $s)
      <tr>
        <td>{{ $s->service_type }}</td>
        <td>{{ $s->due_date ? \Carbon\Carbon::parse($s->due_date)->format('d M Y') : '-' }}</td>
        <td>{{ $s->due_km ? number_format($s->due_km).' km' : '-' }}</td>
        <td><span class="badge {{ $s->status=='done' ? 'badge-green' : ($s->status=='overdue' ? 'badge-red' : 'badge-yellow') }}">{{ $s->status=='done' ? 'Selesai' : ($s->status=='overdue' ? 'Overdue' : 'Upcoming') }}</span></td>
        <td><a href="{{ route('schedules.edit', $s) }}" class="btn-secondary" style="font-size:0.75rem;padding:5px 10px;">Edit</a></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
 
{{-- Riwayat Servis --}}
<div>
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div style="font-size:1rem;font-weight:700;color:#0f172a;">📋 Riwayat Servis</div>
    <a href="{{ route('histories.create') }}" class="btn-primary" style="font-size:0.82rem;padding:8px 14px;">+ Catat</a>
  </div>
  @if($histories->isEmpty())
    <div style="background:#fff;border:1.5px dashed #e2e8f0;border-radius:14px;padding:28px;text-align:center;">
      <div style="font-size:0.88rem;color:#64748b;">Belum ada riwayat servis tercatat</div>
    </div>
  @else
  <div class="table-wrap">
    <table>
      <thead><tr><th>Jenis Servis</th><th>Tanggal</th><th>KM</th><th>Biaya</th><th>Bengkel</th></tr></thead>
      <tbody>
      @foreach($histories as $h)
      <tr>
        <td>{{ $h->service_type }}</td>
        <td>{{ \Carbon\Carbon::parse($h->service_date)->format('d M Y') }}</td>
        <td>{{ number_format($h->km_at_service) }} km</td>
        <td>{{ $h->cost ? 'Rp '.number_format($h->cost,0,',','.') : '-' }}</td>
        <td>{{ $h->bengkel_name ?? '-' }}</td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
@endsection