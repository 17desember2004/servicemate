@extends('layouts.app')
@section('title', 'Settings')
 
@section('content')
<div class="page-header">
  <div><div class="page-title">⚙️ Settings</div><div class="page-sub">Kelola profil dan akun kamu</div></div>
</div>
 
<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;max-width:900px;">
 
  {{-- Update Profil --}}
  <div class="form-card">
    <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:20px;">👤 Update Profil</div>
    <form method="POST" action="{{ route('settings.update') }}">
      @csrf @method('PUT')
      <div class="form-group">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}"
               value="{{ old('name', $user->name) }}" required>
        @error('name')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
               value="{{ old('email', $user->email) }}" required>
        @error('email')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <button type="submit" class="btn-primary">💾 Simpan Profil</button>
    </form>
  </div>
 
  {{-- Update Password --}}
  <div class="form-card">
    <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:20px;">🔒 Ubah Password</div>
    <form method="POST" action="{{ route('settings.password') }}">
      @csrf @method('PUT')
      <div class="form-group">
        <label class="form-label">Password Lama</label>
        <input type="password" name="current_password" class="form-input {{ $errors->has('current_password') ? 'error' : '' }}" required>
        @error('current_password')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
               placeholder="Minimal 8 karakter" required>
        @error('password')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" class="form-input" required>
      </div>
      <button type="submit" class="btn-primary">🔒 Ubah Password</button>
    </form>
  </div>
 
</div>
 
{{-- Info Akun --}}
<div class="form-card" style="max-width:440px;margin-top:20px;">
  <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-bottom:16px;">ℹ️ Info Akun</div>
  <div style="display:flex;flex-direction:column;gap:10px;">
    <div style="display:flex;justify-content:space-between;font-size:0.88rem;"><span style="color:#64748b;">Nama</span><span style="font-weight:600;">{{ $user->name }}</span></div>
    <div style="display:flex;justify-content:space-between;font-size:0.88rem;"><span style="color:#64748b;">Email</span><span style="font-weight:600;">{{ $user->email }}</span></div>
    <div style="display:flex;justify-content:space-between;font-size:0.88rem;"><span style="color:#64748b;">Bergabung</span><span style="font-weight:600;">{{ $user->created_at->format('d M Y') }}</span></div>
  </div>
</div>
@endsection