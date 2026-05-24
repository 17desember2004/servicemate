<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar – ServiceMate</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f8fafc;min-height:100vh;display:flex;align-items:center;justify-content:center;}
.wrap{width:100%;max-width:460px;padding:24px;}
.card{background:#fff;border-radius:20px;padding:40px;box-shadow:0 4px 40px rgba(15,23,42,0.1);border:1px solid #e2e8f0;}
.logo{display:flex;align-items:center;gap:10px;margin-bottom:28px;justify-content:center;}
.logo-icon{width:42px;height:42px;border-radius:12px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;}
.logo-text{font-weight:800;font-size:1.3rem;color:#0f172a;letter-spacing:-0.03em}
.logo-text span{color:#2563eb}
h1{font-size:1.5rem;font-weight:800;color:#0f172a;margin-bottom:6px;text-align:center;letter-spacing:-0.03em}
.sub{text-align:center;color:#64748b;font-size:0.9rem;margin-bottom:28px;}
.form-group{margin-bottom:16px;}
label{display:block;font-size:0.83rem;font-weight:600;color:#374151;margin-bottom:6px;}
input{width:100%;padding:12px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:0.9rem;color:#0f172a;outline:none;transition:border-color .2s;}
input:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,0.1);}
.input-error{border-color:#ef4444!important;}
.error-msg{color:#ef4444;font-size:0.78rem;margin-top:5px;}
.btn{width:100%;padding:14px;background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;border:none;border-radius:12px;font-family:inherit;font-weight:700;font-size:1rem;cursor:pointer;transition:opacity .2s,transform .15s;box-shadow:0 4px 16px rgba(37,99,235,0.3);margin-top:6px;}
.btn:hover{opacity:.92;transform:translateY(-1px);}
.divider{text-align:center;color:#94a3b8;font-size:0.82rem;margin:20px 0;position:relative;}
.divider::before,.divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:#e2e8f0;}
.divider::before{left:0}.divider::after{right:0}
.login-link{text-align:center;font-size:0.88rem;color:#64748b;}
.login-link a{color:#2563eb;font-weight:600;text-decoration:none;}
.login-link a:hover{text-decoration:underline;}
.terms{font-size:0.78rem;color:#94a3b8;text-align:center;margin-top:14px;line-height:1.5;}
</style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <div class="logo">
      <div class="logo-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
          <path d="M5 11L6.5 6.5C6.8 5.6 7.6 5 8.6 5H15.4C16.4 5 17.2 5.6 17.5 6.5L19 11" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
          <rect x="2" y="11" width="20" height="7" rx="2" stroke="white" stroke-width="1.6"/>
          <circle cx="7" cy="18" r="2" fill="white"/>
          <circle cx="17" cy="18" r="2" fill="white"/>
          <path d="M2 14H22" stroke="white" stroke-width="1.6"/>
        </svg>
      </div>
      <span class="logo-text">Service<span>Mate</span></span>
    </div>
 
    <h1>Buat Akun Gratis</h1>
    <p class="sub">Mulai kelola kendaraanmu sekarang</p>
 
    <form method="POST" action="{{ route('register') }}">
      @csrf
 
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name"
               value="{{ old('name') }}"
               placeholder="Nama kamu"
               class="{{ $errors->has('name') ? 'input-error' : '' }}"
               required autofocus>
        @error('name')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
 
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email') }}"
               placeholder="email@kamu.com"
               class="{{ $errors->has('email') ? 'input-error' : '' }}"
               required>
        @error('email')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
 
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               placeholder="Minimal 8 karakter"
               class="{{ $errors->has('password') ? 'input-error' : '' }}"
               required>
        @error('password')<div class="error-msg">{{ $message }}</div>@enderror
      </div>
 
      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               placeholder="Ulangi password"
               required>
      </div>
 
      <button type="submit" class="btn">Daftar Sekarang →</button>
    </form>
 
    <p class="terms">Dengan mendaftar, kamu menyetujui <a href="#" style="color:#2563eb">Syarat & Ketentuan</a> ServiceMate.</p>
    <div class="divider">atau</div>
    <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    <p class="login-link" style="margin-top:10px"><a href="{{ url('/') }}">← Kembali ke beranda</a></p>
  </div>
</div>
</body>
</html>