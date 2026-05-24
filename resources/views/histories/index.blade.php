@extends('layouts.app')
@section('title', 'History')
 
@section('content')
<div class="page-header">
  <div><div class="page-title">📋 Riwayat Servis</div><div class="page-sub">Semua catatan servis kendaraan</div></div>
  <a href="{{ route('histories.create') }}" class="btn-primary">+ Tambah Riwayat</a>
</div>
 
@if($histories->isEmpty())
  <div class="empty"><div class="empty-icon">📋</div><div class="empty-title">Belum ada riwayat</div><a href="{{ route('histories.create') }}" class="btn-primary">+ Catat Servis</a></div>
@else
<div class="table-wrap">
  <table>
    <thead><tr><th>Kendaraan</th><th>Jenis Servis</th><th>Tanggal</th><th>KM</th><th>Biaya</th><th>Bengkel</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($histories as $h)
    <tr>
      <td><span style="font-weight:600;">{{ $h->vehicle->name ?? '-' }}</span></td>
      <td>{{ $h->service_type }}</td>
      <td>{{ \Carbon\Carbon::parse($h->service_date)->format('d M Y') }}</td>
      <td>{{ number_format($h->km_at_service) }} km</td>
      <td>{{ $h->cost ? 'Rp '.number_format($h->cost,0,',','.') : '-' }}</td>
      <td>{{ $h->bengkel_name ?? '-' }}</td>
      <td>
        <form method="POST" action="{{ route('histories.destroy', $h) }}" onsubmit="return confirm('Hapus riwayat ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn-danger">🗑</button>
        </form>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endif
@endsection