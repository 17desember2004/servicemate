@extends('layouts.app')
@section('title', 'Find Bengkel')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">📍 Find Bengkel</div>
    <div class="page-sub">Bengkel terpercaya di sekitarmu</div>
  </div>
</div>
 
{{-- Search --}}
<form method="GET" action="{{ route('bengkel.index') }}" style="margin-bottom:28px;">
  <div style="display:flex;gap:10px;max-width:520px;">
    <input type="text" name="search" class="form-input"
           placeholder="🔍 Cari nama bengkel, kota, atau spesialisasi..."
           value="{{ request('search') }}">
    <button type="submit" class="btn-primary" style="white-space:nowrap;">Cari</button>
    @if(request('search'))
      <a href="{{ route('bengkel.index') }}" class="btn-secondary" style="white-space:nowrap;">Reset</a>
    @endif
  </div>
</form>
 
{{-- Filter kota cepat --}}
<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;">
  @foreach(['Yogyakarta','Jakarta','Bandung','Surabaya','Semarang','Solo'] as $kota)
  <a href="{{ route('bengkel.index') }}?search={{ $kota }}"
     style="padding:6px 16px;border-radius:50px;font-size:0.8rem;font-weight:600;text-decoration:none;
            background:{{ request('search')==$kota ? '#2563eb' : '#f1f5f9' }};
            color:{{ request('search')==$kota ? '#fff' : '#374151' }};
            border:1.5px solid {{ request('search')==$kota ? '#2563eb' : '#e2e8f0' }};">
    {{ $kota }}
  </a>
  @endforeach
</div>
 
@if($bengkels->isEmpty())
  <div class="empty">
    <div class="empty-icon">📍</div>
    <div class="empty-title">Bengkel tidak ditemukan</div>
    <div class="empty-sub">Coba kata kunci atau kota lain</div>
    <a href="{{ route('bengkel.index') }}" class="btn-secondary">Lihat Semua Bengkel</a>
  </div>
@else
  <div style="margin-bottom:14px;font-size:0.85rem;color:#64748b;">
    Menampilkan <strong>{{ $bengkels->count() }}</strong> bengkel
    @if(request('search')) untuk "<strong>{{ request('search') }}</strong>" @endif
  </div>
 
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;">
    @foreach($bengkels as $b)
    <div style="background:#fff;border:1.5px solid #e2e8f0;border-radius:16px;overflow:hidden;transition:box-shadow .2s,border-color .2s;"
         onmouseover="this.style.boxShadow='0 8px 24px rgba(15,23,42,0.1)';this.style.borderColor='#bfdbfe'"
         onmouseout="this.style.boxShadow='none';this.style.borderColor='#e2e8f0'">
 
      {{-- Card Header --}}
      <div style="padding:18px 18px 14px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px;">
          <div style="flex:1;">
            <div style="font-weight:700;font-size:0.97rem;color:#0f172a;margin-bottom:3px;">
              {{ $b->name }}
            </div>
            <div style="font-size:0.78rem;color:#64748b;display:flex;align-items:center;gap:4px;">
              📍 {{ $b->address }}, {{ $b->city }}
            </div>
          </div>
          @if($b->is_verified)
          <span style="background:#dbeafe;color:#1d4ed8;font-size:0.65rem;font-weight:700;padding:3px 8px;border-radius:50px;white-space:nowrap;margin-left:8px;">
            ✓ Verified
          </span>
          @endif
        </div>
 
        {{-- Spesialisasi --}}
        @if($b->specialization)
        <div style="margin-bottom:10px;">
          <span style="background:#f1f5f9;color:#374151;font-size:0.75rem;font-weight:600;padding:4px 10px;border-radius:50px;">
            🔧 {{ $b->specialization }}
          </span>
        </div>
        @endif
 
        {{-- Rating --}}
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:14px;">
          <span style="color:#f59e0b;font-size:1rem;letter-spacing:1px;">
            @for($i=1;$i<=5;$i++)
              {{ $i <= (int)$b->rating ? '★' : '☆' }}
            @endfor
          </span>
          <span style="font-weight:700;font-size:0.88rem;color:#0f172a;">{{ $b->rating }}</span>
          <span style="font-size:0.75rem;color:#94a3b8;">/ 5.0</span>
        </div>
 
        {{-- Tombol Aksi --}}
        <div style="display:flex;gap:8px;">
          @if($b->phone)
          <a href="tel:{{ $b->phone }}"
             style="flex:1;text-align:center;padding:9px;border-radius:9px;font-size:0.8rem;font-weight:600;
                    text-decoration:none;background:#dbeafe;color:#1d4ed8;
                    transition:background .2s;"
             onmouseover="this.style.background='#bfdbfe'"
             onmouseout="this.style.background='#dbeafe'">
            📞 Hubungi
          </a>
          @endif
 
          {{-- Tombol Lihat di Google Maps --}}
          <a href="https://www.google.com/maps/search/{{ urlencode($b->name . ' ' . $b->address . ' ' . $b->city) }}"
             target="_blank"
             style="flex:1;text-align:center;padding:9px;border-radius:9px;font-size:0.8rem;font-weight:600;
                    text-decoration:none;background:#dcfce7;color:#15803d;
                    transition:background .2s;"
             onmouseover="this.style.background='#bbf7d0'"
             onmouseout="this.style.background='#dcfce7'">
            🗺️ Lihat Maps
          </a>
        </div>
      </div>
 
      {{-- Google Maps Embed --}}
      <div style="border-top:1px solid #f1f5f9;">
        <iframe
          width="100%"
          height="160"
          style="border:0;display:block;"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://maps.google.com/maps?q={{ urlencode($b->name . ' ' . $b->city) }}&output=embed&z=15"
          allowfullscreen>
        </iframe>
      </div>
 
    </div>
    @endforeach
  </div>
@endif
@endsection