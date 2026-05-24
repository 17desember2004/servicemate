@extends('layouts.app')
@section('title', 'Tambah Jadwal')
 
@section('content')
<div class="page-header">
  <div>
    <div class="page-title">📅 Tambah Jadwal Servis</div>
    <div class="page-sub">Jadwal otomatis menyesuaikan jenis kendaraan</div>
  </div>
  <a href="{{ route('schedules.index') }}" class="btn-secondary">← Kembali</a>
</div>
 
<div class="form-card" style="max-width:640px;">
  <form method="POST" action="{{ route('schedules.store') }}">
    @csrf
 
    {{-- Pilih Kendaraan --}}
    <div class="form-group">
      <label class="form-label">🚗 Kendaraan *</label>
      <select name="vehicle_id" class="form-input" id="vehicle-select" required onchange="updateServiceTypes()">
        <option value="">-- Pilih Kendaraan --</option>
        @foreach($vehicles as $v)
          <option value="{{ $v->id }}"
                  data-fuel="{{ $v->fuel_type }}"
                  data-name="{{ $v->name }}"
                  {{ (old('vehicle_id', request('vehicle_id'))==$v->id) ? 'selected' : '' }}>
            {{ $v->name }} ({{ $v->plate_number }})
          </option>
        @endforeach
      </select>
      @error('vehicle_id')<div class="form-error">{{ $message }}</div>@enderror
    </div>
 
    {{-- Info kendaraan terpilih --}}
    <div id="vehicle-info" style="display:none;background:#f0f9ff;border:1px solid #bae6fd;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:0.85rem;color:#0369a1;">
      <span id="vehicle-info-text"></span>
    </div>
 
    {{-- Jenis Servis --}}
    <div class="form-group">
      <label class="form-label">🔧 Jenis Servis *</label>
      <select name="service_type" id="service-select" class="form-input" required onchange="checkOther(this)">
        <option value="">-- Pilih kendaraan dulu --</option>
      </select>
      @error('service_type')<div class="form-error">{{ $message }}</div>@enderror
    </div>
 
    {{-- Input manual jika pilih "Lainnya" --}}
    <div class="form-group" id="custom-group" style="display:none;">
      <label class="form-label">Ketik Jenis Servis</label>
      <input type="text" name="service_type_custom" id="custom-input" class="form-input"
             placeholder="Contoh: Ganti V-Belt, Servis Karburator..." value="{{ old('service_type_custom') }}">
    </div>
 
    {{-- Tanggal + Jam --}}
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">📆 Tanggal Due</label>
        <input type="date" name="due_date" class="form-input"
               value="{{ old('due_date') }}" min="{{ date('Y-m-d') }}">
      </div>
      <div class="form-group">
        <label class="form-label">⏰ Jam Servis</label>
        <select name="service_time" class="form-input">
          <option value="">-- Pilih Jam --</option>
          @for($h = 7; $h <= 21; $h++)
            @php $time = sprintf('%02d:00', $h); @endphp
            <option value="{{ $time }}" {{ old('service_time')==$time ? 'selected':'' }}>
              {{ $time }} WIB — @if($h<12) Pagi @elseif($h<15) Siang @elseif($h<18) Sore @else Malam @endif
            </option>
            @if($h < 21)
              @php $time2 = sprintf('%02d:30', $h); @endphp
              <option value="{{ $time2 }}" {{ old('service_time')==$time2 ? 'selected':'' }}>
                {{ $time2 }} WIB
              </option>
            @endif
          @endfor
        </select>
      </div>
    </div>
 
    {{-- KM Due --}}
    <div class="form-group">
      <label class="form-label">🛣️ KM Due (opsional)</label>
      <input type="number" name="due_km" class="form-input"
             value="{{ old('due_km') }}" placeholder="Contoh: 50000">
      <div style="font-size:0.75rem;color:#94a3b8;margin-top:4px;">
        Jadwal otomatis overdue jika KM kendaraan melewati angka ini
      </div>
    </div>
 
    {{-- Catatan --}}
    <div class="form-group">
      <label class="form-label">📝 Catatan (opsional)</label>
      <textarea name="notes" class="form-input" rows="2"
                placeholder="Contoh: Pakai oli Shell Helix 10W-40, sekalian cek rem">{{ old('notes') }}</textarea>
    </div>
 
    <div style="display:flex;gap:10px;margin-top:4px;">
      <button type="submit" class="btn-primary">💾 Simpan Jadwal</button>
      <a href="{{ route('schedules.index') }}" class="btn-secondary">Batal</a>
    </div>
  </form>
</div>
 
@push('scripts')
<script>
// Data jenis servis per tipe kendaraan
const serviceTypes = {
  bensin: {
    label: '🚗 Kendaraan Bensin',
    groups: [
      { label: '🛢️ Oli & Cairan', items: ['Ganti Oli Mesin','Ganti Oli Transmisi','Ganti Oli Gardan','Isi Coolant/Air Radiator','Ganti Minyak Rem'] },
      { label: '⚙️ Tune Up & Filter', items: ['Tune Up','Ganti Filter Udara','Ganti Filter Oli','Ganti Busi','Setel Karburator/Injeksi'] },
      { label: '🛞 Ban & Rem', items: ['Ganti Ban','Rotasi Ban','Spooring & Balancing','Ganti Kampas Rem','Servis Rem'] },
      { label: '❄️ AC & Kelistrikan', items: ['Servis AC','Isi Freon AC','Ganti Aki/Baterai','Servis Kelistrikan'] },
      { label: '🔩 Lainnya', items: ['Servis Umum','Servis Kopling','Ganti Timing Belt','other'] },
    ]
  },
  diesel: {
    label: '🚐 Kendaraan Diesel',
    groups: [
      { label: '🛢️ Oli & Cairan', items: ['Ganti Oli Mesin Diesel','Ganti Filter Solar','Ganti Oli Transmisi','Isi Coolant','Bleeding Sistem Bahan Bakar'] },
      { label: '⚙️ Servis Mesin', items: ['Tune Up Diesel','Ganti Turbo Filter','Servis Injector','Ganti Filter Udara','Ganti Filter Oli'] },
      { label: '🛞 Ban & Rem', items: ['Ganti Ban','Rotasi Ban','Spooring & Balancing','Ganti Kampas Rem','Servis Rem Angin'] },
      { label: '🔩 Lainnya', items: ['Servis Umum','Servis Kopling','Ganti Timing Belt','other'] },
    ]
  },
  listrik: {
    label: '⚡ Kendaraan Listrik',
    groups: [
      { label: '🔋 Baterai & Daya', items: ['Cek Kesehatan Baterai','Kalibrasi Baterai','Servis Pengisian Daya','Ganti Baterai 12V Auxiliary'] },
      { label: '⚙️ Servis Rutin', items: ['Rotasi Ban','Spooring & Balancing','Ganti Kampas Rem','Servis Rem Regeneratif','Ganti Cairan Pendingin Motor Listrik'] },
      { label: '💻 Software & Kelistrikan', items: ['Update Software/Firmware','Servis Kelistrikan','Kalibrasi Sensor','Servis AC Heat Pump'] },
      { label: '🔩 Lainnya', items: ['Inspeksi Umum','other'] },
    ]
  },
  hybrid: {
    label: '🔋 Kendaraan Hybrid',
    groups: [
      { label: '🛢️ Oli & Cairan', items: ['Ganti Oli Mesin','Ganti Filter Oli','Isi Coolant','Ganti Minyak Rem'] },
      { label: '🔋 Baterai Hybrid', items: ['Cek Baterai Hybrid','Kalibrasi Baterai Hybrid','Servis Sistem Hybrid'] },
      { label: '⚙️ Servis Rutin', items: ['Tune Up','Ganti Filter Udara','Ganti Busi','Rotasi Ban','Spooring & Balancing','Ganti Kampas Rem'] },
      { label: '❄️ AC & Kelistrikan', items: ['Servis AC','Isi Freon AC','Update Software','Servis Kelistrikan'] },
      { label: '🔩 Lainnya', items: ['Servis Umum','other'] },
    ]
  },
  // Motor (deteksi dari nama kendaraan)
  motor: {
    label: '🏍️ Sepeda Motor',
    groups: [
      { label: '🛢️ Oli & Cairan', items: ['Ganti Oli Mesin Motor','Ganti Oli Gardan Motor','Ganti Minyak Rem Motor'] },
      { label: '⚙️ Tune Up Motor', items: ['Tune Up Motor','Ganti Busi Motor','Setel Klep Motor','Bersih Karburator','Servis Injeksi Motor','Ganti Filter Udara Motor'] },
      { label: '🛞 Ban & Rem', items: ['Ganti Ban Depan','Ganti Ban Belakang','Ganti Kampas Rem Depan','Ganti Kampas Rem Belakang','Setel Rem'] },
      { label: '⛓️ Transmisi', items: ['Ganti Rantai & Gear','Setel Rantai Motor','Ganti Kampas Kopling','Ganti V-Belt (Matic)','Ganti Roller (Matic)'] },
      { label: '🔋 Kelistrikan', items: ['Ganti Aki Motor','Servis Kelistrikan Motor'] },
      { label: '🔩 Lainnya', items: ['Servis Umum Motor','other'] },
    ]
  }
};
 
function isMotor(name) {
  const motorKeywords = ['motor','beat','vario','mio','nmax','pcx','aerox','cbr','ninja','r15','rx','satria','supra','revo','honda cb','yamaha','kawasaki ninja','suzuki gsx','honda crf','vespa','scoopy','fino'];
  const nameLower = name.toLowerCase();
  return motorKeywords.some(k => nameLower.includes(k));
}
 
function updateServiceTypes() {
  const sel = document.getElementById('vehicle-select');
  const opt = sel.options[sel.selectedIndex];
  const serviceSel = document.getElementById('service-select');
  const infoDiv = document.getElementById('vehicle-info');
  const infoText = document.getElementById('vehicle-info-text');
 
  if (!opt.value) {
    serviceSel.innerHTML = '<option value="">-- Pilih kendaraan dulu --</option>';
    infoDiv.style.display = 'none';
    return;
  }
 
  const fuel = opt.dataset.fuel || 'bensin';
  const name = opt.dataset.name || '';
  const isMotorVehicle = isMotor(name);
 
  // Tentukan tipe
  let typeKey = fuel;
  if (isMotorVehicle) typeKey = 'motor';
 
  const data = serviceTypes[typeKey] || serviceTypes['bensin'];
 
  // Update info
  infoDiv.style.display = 'block';
  infoText.innerHTML = `✅ Menampilkan jenis servis untuk: <strong>${data.label}</strong>`;
 
  // Build options
  let html = '<option value="">-- Pilih Jenis Servis --</option>';
  data.groups.forEach(g => {
    html += `<optgroup label="${g.label}">`;
    g.items.forEach(item => {
      const label = item === 'other' ? 'Lainnya (ketik sendiri)' : item;
      html += `<option value="${item}">${label}</option>`;
    });
    html += '</optgroup>';
  });
 
  serviceSel.innerHTML = html;
  document.getElementById('custom-group').style.display = 'none';
}
 
function checkOther(sel) {
  const customGroup = document.getElementById('custom-group');
  const customInput = document.getElementById('custom-input');
  if (sel.value === 'other') {
    customGroup.style.display = 'block';
    customInput.required = true;
  } else {
    customGroup.style.display = 'none';
    customInput.required = false;
  }
}
 
// Jalankan saat load jika ada kendaraan terpilih
window.addEventListener('DOMContentLoaded', () => {
  const sel = document.getElementById('vehicle-select');
  if (sel.value) updateServiceTypes();
});
</script>
@endpush
@endsection