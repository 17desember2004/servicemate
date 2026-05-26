<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') – ServiceMate</title>
<link rel="manifest" href="/manifest.json">
<meta name="theme-color" content="#0f172a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="ServiceMate">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f8fafc;color:#0f172a;display:flex;min-height:100vh;}
 
/* ═══ SIDEBAR ═══ */
.sidebar{
  width:240px;flex-shrink:0;background:#0f172a;
  display:flex;flex-direction:column;
  position:fixed;top:0;left:0;height:100vh;
  z-index:200;
  /* NO transform — always visible on all screens */
}
.sidebar-brand{display:flex;align-items:center;gap:10px;padding:18px 16px;border-bottom:1px solid rgba(255,255,255,0.08);min-height:64px;}
.brand-icon{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;flex-shrink:0;line-height:1;}
.brand-name{font-weight:800;font-size:1.1rem;color:#fff;letter-spacing:-0.03em;line-height:1;}
.brand-name span{color:#38bdf8}
.sidebar-nav{flex:1;padding:16px 12px;overflow-y:auto;}
.nav-label{font-size:0.65rem;font-weight:700;color:rgba(255,255,255,0.3);letter-spacing:.1em;text-transform:uppercase;padding:6px 8px 4px;margin-top:8px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:rgba(255,255,255,0.55);text-decoration:none;font-size:0.88rem;font-weight:500;transition:background .2s,color .2s;margin-bottom:2px;}
.nav-item:hover{background:rgba(255,255,255,0.07);color:#fff;}
.nav-item.active{background:rgba(37,99,235,0.3);color:#fff;font-weight:600;}
.nav-icon{font-size:16px;width:20px;text-align:center;flex-shrink:0;}
.sidebar-footer{padding:16px 20px;border-top:1px solid rgba(255,255,255,0.08);}
.user-info{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
.user-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.9rem;flex-shrink:0;}
.user-name{font-size:0.85rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.user-email{font-size:0.72rem;color:rgba(255,255,255,0.4);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.logout-btn{width:100%;padding:9px;background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#fca5a5;border-radius:9px;font-family:inherit;font-size:0.82rem;font-weight:600;cursor:pointer;transition:background .2s;}
.logout-btn:hover{background:rgba(239,68,68,0.25);}
 
/* ═══ MAIN ═══ */
.main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh;min-width:0;}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:0 20px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-left{display:flex;align-items:center;gap:12px;}
.topbar-title{font-size:1rem;font-weight:700;color:#0f172a;}
.topbar-right{display:flex;align-items:center;gap:10px;}
.notif-btn{width:36px;height:36px;border-radius:50%;background:#f1f5f9;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;transition:background .2s;position:relative;text-decoration:none;}
.notif-btn:hover{background:#e2e8f0;}
.notif-badge{position:absolute;top:5px;right:5px;width:8px;height:8px;border-radius:50%;background:#ef4444;border:2px solid #fff;}
.content{padding:20px;flex:1;overflow-x:hidden;}
 
/* ═══ ALERTS ═══ */
.alert-success{background:#f0fdf4;border:1px solid #86efac;color:#16a34a;padding:12px 16px;border-radius:10px;font-size:0.88rem;margin-bottom:20px;}
.alert-error-box{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:12px 16px;border-radius:10px;font-size:0.88rem;margin-bottom:20px;}
 
/* ═══ PAGE ═══ */
.page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;gap:12px;flex-wrap:wrap;}
.page-title{font-size:1.3rem;font-weight:800;color:#0f172a;letter-spacing:-0.03em;}
.page-sub{font-size:0.85rem;color:#64748b;margin-top:3px;}
 
/* ═══ BUTTONS ═══ */
.btn-primary{background:#2563eb;color:#fff;padding:9px 18px;border-radius:10px;font-family:inherit;font-weight:600;font-size:0.85rem;border:none;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:background .2s,transform .15s;white-space:nowrap;}
.btn-primary:hover{background:#1d4ed8;transform:translateY(-1px);}
.btn-secondary{background:#f1f5f9;color:#374151;padding:9px 16px;border-radius:10px;font-family:inherit;font-weight:600;font-size:0.85rem;border:1px solid #e2e8f0;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:background .2s;white-space:nowrap;}
.btn-secondary:hover{background:#e2e8f0;}
.btn-danger{background:#fef2f2;color:#dc2626;padding:7px 14px;border-radius:8px;font-family:inherit;font-weight:600;font-size:0.8rem;border:1px solid #fecaca;cursor:pointer;text-decoration:none;transition:background .2s;}
.btn-danger:hover{background:#fee2e2;}
 
/* ═══ TABLE ═══ */
.table-wrap{background:#fff;border-radius:14px;border:1px solid #e2e8f0;overflow-x:auto;}
table{width:100%;border-collapse:collapse;min-width:500px;}
th{padding:11px 14px;text-align:left;font-size:0.72rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;background:#f8fafc;border-bottom:1px solid #e2e8f0;white-space:nowrap;}
td{padding:12px 14px;font-size:0.85rem;color:#374151;border-bottom:1px solid #f1f5f9;vertical-align:middle;}
tr:last-child td{border-bottom:none;}
tr:hover td{background:#fafafa;}
 
/* ═══ BADGES ═══ */
.badge{display:inline-flex;align-items:center;padding:3px 9px;border-radius:50px;font-size:0.7rem;font-weight:600;}
.badge-green{background:#dcfce7;color:#16a34a;}
.badge-red{background:#fee2e2;color:#dc2626;}
.badge-yellow{background:#fef9c3;color:#a16207;}
.badge-blue{background:#dbeafe;color:#1d4ed8;}
.badge-gray{background:#f1f5f9;color:#64748b;}
 
/* ═══ FORMS ═══ */
.form-card{background:#fff;border-radius:14px;border:1px solid #e2e8f0;padding:22px;}
.form-group{margin-bottom:18px;}
.form-label{display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;}
.form-input{width:100%;padding:10px 13px;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:0.88rem;color:#0f172a;outline:none;transition:border-color .2s;}
.form-input:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,0.1);}
.form-input.error{border-color:#ef4444;}
.form-error{color:#ef4444;font-size:0.76rem;margin-top:4px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
select.form-input{background:#fff;}
textarea.form-input{resize:vertical;min-height:90px;}
 
/* ═══ STATS ═══ */
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:20px;}
.stat-card{background:#fff;border-radius:12px;padding:16px;border:1px solid #e2e8f0;}
.stat-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:10px;}
.stat-icon.blue{background:#dbeafe;}.stat-icon.green{background:#dcfce7;}.stat-icon.orange{background:#ffedd5;}.stat-icon.red{background:#fee2e2;}
.stat-val{font-size:1.6rem;font-weight:800;color:#0f172a;letter-spacing:-0.04em;line-height:1;}
.stat-lbl{font-size:0.75rem;color:#64748b;margin-top:4px;}
 
/* ═══ EMPTY ═══ */
.empty{text-align:center;padding:40px 20px;}
.empty-icon{font-size:40px;margin-bottom:12px;}
.empty-title{font-size:0.95rem;font-weight:700;color:#0f172a;margin-bottom:6px;}
.empty-sub{font-size:0.85rem;color:#64748b;margin-bottom:16px;}
 
/* ═══ PWA Banner ═══ */
#pwa-banner{display:none;position:fixed;bottom:16px;right:16px;z-index:9999;background:#0f172a;color:#fff;border-radius:14px;padding:14px 16px;box-shadow:0 8px 30px rgba(0,0,0,0.3);max-width:280px;border:1px solid rgba(255,255,255,0.1);}
#pwa-banner strong{color:#fff;display:block;margin-bottom:4px;font-size:0.88rem;}
#pwa-banner p{font-size:0.78rem;margin-bottom:10px;color:rgba(255,255,255,0.7);}
.pwa-btns{display:flex;gap:8px;}
.pwa-install{background:#2563eb;color:#fff;border:none;padding:7px 14px;border-radius:8px;font-size:0.78rem;font-weight:600;cursor:pointer;font-family:inherit;}
.pwa-dismiss{background:transparent;color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.15);padding:7px 10px;border-radius:8px;font-size:0.78rem;cursor:pointer;font-family:inherit;}
 
/* ═══ RESPONSIVE MOBILE ═══
   Sidebar menyempit tapi TETAP TAMPIL — tidak disembunyikan
   Teks nav disembunyikan, hanya icon yang tampil
*/
@media(max-width:768px){
  /* Sidebar menyempit jadi icon-only */
  .sidebar{width:56px;}
  .brand-name{display:none;}
  .nav-label{display:none;}
  .nav-item{padding:10px 0;justify-content:center;gap:0;}
  .nav-item span:not(.nav-icon){display:none;}
  .nav-icon{width:100%;text-align:center;font-size:18px;}
  .sidebar-footer{padding:10px 8px;}
  .user-name,.user-email{display:none;}
  .user-avatar{margin:0 auto 8px;}
  .user-info{flex-direction:column;align-items:center;gap:0;margin-bottom:8px;}
  .logout-btn{font-size:0;}
  .logout-btn::after{content:'🚪';font-size:16px;}
  .logout-btn{padding:8px;text-align:center;}
 
  /* Main mengikuti sidebar yang sempit */
  .main{margin-left:56px;}
 
  /* Topbar */
  .topbar{padding:0 14px;}
  .topbar-title{font-size:0.9rem;}
 
  /* Content */
  .content{padding:14px;}
 
  /* Page header */
  .page-header{flex-direction:column;align-items:flex-start;gap:10px;}
  .page-title{font-size:1.1rem;}
 
  /* Stats grid 2 kolom */
  .stats-grid{grid-template-columns:1fr 1fr;gap:10px;}
  .stat-val{font-size:1.3rem;}
 
  /* Form row single column */
  .form-row{grid-template-columns:1fr;}
  .form-card{padding:16px;}
 
  /* Table scroll */
  .table-wrap{border-radius:10px;}
  table{min-width:400px;}
  th,td{padding:10px 12px;font-size:0.8rem;}
 
  /* Dashboard & vehicle grid */
  .dash-grid{grid-template-columns:1fr !important;}
  .vehicle-card-grid{grid-template-columns:1fr !important;}
 
  /* Buttons */
  .btn-primary,.btn-secondary{padding:8px 12px;font-size:0.8rem;}
 
  /* PWA banner */
  #pwa-banner{left:70px;right:16px;max-width:none;bottom:16px;}
 
  /* Sidebar footer — sembunyikan teks, tampilkan ikon saja */
  .sidebar-footer{padding:8px 6px;}
  .user-info{flex-direction:column;align-items:center;gap:4px;margin-bottom:8px;}
  .user-name,.user-email{display:none;}
  .user-avatar{margin:0 auto;}
  /* Logout: hanya ikon 🚪 */
  .logout-btn{padding:7px 0;font-size:0;border-radius:8px;}
  .logout-btn::before{content:'🚪';font-size:16px;}
}
 
/* Layar sangat kecil — sidebar icon lebih kecil */
@media(max-width:400px){
  .sidebar{width:46px;}
  .main{margin-left:46px;}
  .nav-icon{font-size:16px;}
}
</style>
@stack('styles')
</head>
<body>
 
{{-- SIDEBAR — selalu tampil di semua ukuran layar --}}
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
        <path d="M5 11L6.5 6.5C6.8 5.6 7.6 5 8.6 5H15.4C16.4 5 17.2 5.6 17.5 6.5L19 11" stroke="white" stroke-width="1.7" stroke-linecap="round"/>
        <rect x="2" y="11" width="20" height="7" rx="2" stroke="white" stroke-width="1.7"/>
        <circle cx="7" cy="18" r="1.8" fill="white"/>
        <circle cx="17" cy="18" r="1.8" fill="white"/>
        <path d="M2 14H22" stroke="white" stroke-width="1.7"/>
      </svg>
    </div>
    <span class="brand-name">Service<span>Mate</span></span>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-label">Menu Utama</div>
    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
      <span class="nav-icon">📊</span> <span>Dashboard</span>
    </a>
    <a href="{{ route('vehicles.index') }}" class="nav-item {{ request()->routeIs('vehicles.*') ? 'active' : '' }}" title="My Vehicles">
      <span class="nav-icon">🚗</span> <span>My Vehicles</span>
    </a>
    <a href="{{ route('schedules.index') }}" class="nav-item {{ request()->routeIs('schedules.*') ? 'active' : '' }}" title="Schedule">
      <span class="nav-icon">📅</span> <span>Schedule</span>
    </a>
    <a href="{{ route('reminders.index') }}" class="nav-item {{ request()->routeIs('reminders.*') ? 'active' : '' }}" title="Reminders">
      <span class="nav-icon">🔔</span> <span>Reminders</span>
    </a>
    <a href="{{ route('histories.index') }}" class="nav-item {{ request()->routeIs('histories.*') ? 'active' : '' }}" title="History">
      <span class="nav-icon">📋</span> <span>History</span>
    </a>
    <div class="nav-label">Lainnya</div>
    <a href="{{ route('bengkel.index') }}" class="nav-item {{ request()->routeIs('bengkel.*') ? 'active' : '' }}" title="Find Bengkel">
      <span class="nav-icon">📍</span> <span>Find Bengkel</span>
    </a>
    <a href="{{ route('settings') }}" class="nav-item {{ request()->routeIs('settings*') ? 'active' : '' }}" title="Settings">
      <span class="nav-icon">⚙️</span> <span>Settings</span>
    </a>
  </nav>
  <div class="sidebar-footer">
    <div class="user-info">
      <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      <div>
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-email">{{ auth()->user()->email }}</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="logout-btn">🚪 Keluar</button>
    </form>
  </div>
</aside>
 
{{-- MAIN --}}
<div class="main">
  <header class="topbar">
    <div class="topbar-left">
      <div class="topbar-title">@yield('title', 'Dashboard')</div>
    </div>
    <div class="topbar-right">
      <a href="{{ route('reminders.index') }}" class="notif-btn" title="Reminders">
        🔔
        @if(isset($unreadCount) && $unreadCount > 0)
          <span class="notif-badge"></span>
        @endif
      </a>
      <a href="{{ url('/') }}" style="font-size:0.78rem;color:#64748b;text-decoration:none;white-space:nowrap;">🏠 Beranda</a>
    </div>
  </header>
 
  <div class="content">
    @if(session('success'))<div class="alert-success">✅ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert-error-box">❌ {{ session('error') }}</div>@endif
    @yield('content')
  </div>
</div>
 
{{-- PWA Banner --}}
<div id="pwa-banner">
  <strong>📱 Install ServiceMate</strong>
  <p>Tambahkan ke layar utama HP!</p>
  <div class="pwa-btns">
    <button class="pwa-install" id="pwa-install-btn">⬇️ Install</button>
    <button class="pwa-dismiss" id="pwa-dismiss-btn">Nanti</button>
  </div>
</div>
 
<script>
// PWA
let deferredPrompt;
window.addEventListener('beforeinstallprompt',(e)=>{
  e.preventDefault(); deferredPrompt=e;
  setTimeout(()=>{document.getElementById('pwa-banner').style.display='block';},3000);
});
document.getElementById('pwa-install-btn').addEventListener('click',async()=>{
  document.getElementById('pwa-banner').style.display='none';
  if(deferredPrompt){deferredPrompt.prompt();deferredPrompt=null;}
});
document.getElementById('pwa-dismiss-btn').addEventListener('click',()=>{
  document.getElementById('pwa-banner').style.display='none';
});
</script>
@stack('scripts')
</body>
</html>