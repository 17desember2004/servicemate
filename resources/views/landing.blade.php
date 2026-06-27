@php
    $content = \Illuminate\Support\Facades\DB::table('settings')->pluck('value', 'key')->toArray();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ServiceMate – Smart Vehicle Maintenance</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Plus Jakarta Sans',sans-serif;background:#fff;color:#0f172a;overflow-x:hidden}
 
:root{
  --brand:#2563eb;
  --brand-light:#3b82f6;
  --brand-dark:#1d4ed8;
  --cyan:#06b6d4;
  --surface:#f8fafc;
  --border:#e2e8f0;
  --text:#0f172a;
  --muted:#64748b;
  --white:#ffffff;
}
 
/* NAV */
nav{
  position:fixed;top:0;width:100%;z-index:200;
  padding:0 5%;height:68px;
  display:flex;align-items:center;justify-content:space-between;
  background:rgba(255,255,255,0.92);
  backdrop-filter:blur(20px);
  border-bottom:1px solid rgba(226,232,240,0.8);
  transition:box-shadow .3s;
}
nav.scrolled{box-shadow:0 4px 24px rgba(15,23,42,0.08)}
.nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none}
.nav-logo-icon{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.nav-logo-text{font-weight:800;font-size:1.2rem;color:var(--text);letter-spacing:-0.03em}
.nav-logo-text span{color:var(--brand)}
.nav-links{display:flex;align-items:center;gap:8px;list-style:none}
.nav-links a{color:var(--muted);text-decoration:none;font-size:0.9rem;font-weight:500;padding:8px 14px;border-radius:8px;transition:color .2s,background .2s;}
.nav-links a:hover{color:var(--text);background:#f1f5f9}
.nav-btn-ghost{color:var(--text)!important;font-weight:600!important}
.nav-btn-solid{background:var(--brand)!important;color:#fff!important;padding:9px 20px!important;border-radius:10px!important;font-weight:600!important;font-size:0.88rem!important;box-shadow:0 2px 8px rgba(37,99,235,0.3);transition:background .2s,transform .15s,box-shadow .2s!important;}
.nav-btn-solid:hover{background:var(--brand-dark)!important;transform:translateY(-1px);box-shadow:0 4px 16px rgba(37,99,235,0.4)!important}
 
/* HERO */
#hero{padding:140px 5% 100px;background:var(--surface);text-align:center;position:relative;overflow:hidden;}
.hero-glow{position:absolute;top:-30%;left:50%;transform:translateX(-50%);width:1100px;height:700px;border-radius:50%;background:radial-gradient(ellipse,rgba(37,99,235,0.1) 0%,transparent 70%);pointer-events:none;}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:#fff;border:1px solid var(--border);border-radius:50px;padding:8px 20px;margin-bottom:32px;font-size:0.88rem;font-weight:600;color:var(--brand);box-shadow:0 2px 12px rgba(15,23,42,0.08);}
.hero-badge-dot{width:8px;height:8px;border-radius:50%;background:#22c55e;animation:blink 1.6s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
h1{font-size:clamp(3rem,6vw,5rem);font-weight:800;line-height:1.08;letter-spacing:-0.04em;color:var(--text);margin-bottom:24px;max-width:820px;margin-left:auto;margin-right:auto;}
h1 .accent{color:var(--brand)}
.hero-sub{font-size:1.18rem;color:var(--muted);line-height:1.75;max-width:580px;margin:0 auto 44px;font-weight:400;}
.hero-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;margin-bottom:20px}
.btn-blue{background:var(--brand);color:#fff;border:none;cursor:pointer;padding:17px 36px;border-radius:14px;font-family:inherit;font-weight:700;font-size:1.05rem;text-decoration:none;display:inline-flex;align-items:center;gap:9px;box-shadow:0 6px 20px rgba(37,99,235,0.38);transition:background .2s,transform .15s,box-shadow .2s;}
.btn-blue:hover{background:var(--brand-dark);transform:translateY(-2px);box-shadow:0 10px 30px rgba(37,99,235,0.45)}
.btn-outline{background:#fff;color:var(--text);border:1.5px solid var(--border);padding:16px 32px;border-radius:14px;font-family:inherit;font-weight:600;font-size:1.05rem;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:9px;transition:border-color .2s,background .2s,transform .15s;}
.btn-outline:hover{border-color:var(--brand);background:#eff6ff;transform:translateY(-2px)}
.hero-trust{display:flex;align-items:center;justify-content:center;gap:24px;flex-wrap:wrap}
.trust-item{display:flex;align-items:center;gap:7px;font-size:0.9rem;color:var(--muted);font-weight:500}
 
/* MOCKUP */
.mockup-wrap{max-width:1020px;margin:72px auto 0;position:relative;animation:float-up .9s ease both;}
@keyframes float-up{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:none}}
.mockup-bar{background:#1e293b;border-radius:14px 14px 0 0;padding:12px 18px;display:flex;align-items:center;gap:12px;border-bottom:1px solid rgba(255,255,255,0.06);}
.mock-dots{display:flex;gap:6px}
.mock-dots span{width:11px;height:11px;border-radius:50%}
.mock-dots .r{background:#ff5f57}.mock-dots .y{background:#febc2e}.mock-dots .g{background:#28c840}
.mock-url{flex:1;background:rgba(255,255,255,0.06);border-radius:6px;padding:5px 12px;font-size:0.72rem;color:rgba(255,255,255,0.4);text-align:center;font-family:monospace;}
.mockup-body{background:#fff;border:1px solid var(--border);border-top:none;border-radius:0 0 14px 14px;overflow:hidden;box-shadow:0 24px 80px rgba(15,23,42,0.14);}
.mock-layout{display:flex;min-height:440px}
.mock-sidebar{width:220px;flex-shrink:0;background:#f8fafc;border-right:1px solid var(--border);padding:24px 16px;display:flex;flex-direction:column;gap:4px;}
.mock-brand{display:flex;align-items:center;gap:8px;padding:0 6px 18px;border-bottom:1px solid var(--border);margin-bottom:14px;}
.mock-brand-icon{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;}
.mock-brand-name{font-size:0.9rem;font-weight:700;color:var(--text)}
.mock-nav-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;font-size:0.82rem;font-weight:500;color:var(--muted);cursor:pointer;transition:background .2s,color .2s;}
.mock-nav-item.active{background:#eff6ff;color:var(--brand);font-weight:600}
.mock-nav-icon{font-size:16px;width:18px;text-align:center}
.mock-main{flex:1;padding:28px 30px;background:#fff;overflow:hidden}
.mock-topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.mock-title{font-size:1.1rem;font-weight:700;color:var(--text)}
.mock-add-btn{background:var(--brand);color:#fff;padding:8px 18px;border-radius:8px;font-size:0.8rem;font-weight:600;cursor:pointer;border:none;}
.vehicle-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px}
.vehicle-card{border:1.5px solid var(--border);border-radius:14px;padding:20px;cursor:pointer;}
.vc-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
.vc-name{font-size:0.92rem;font-weight:700;color:var(--text)}
.vc-badge{font-size:0.68rem;font-weight:600;padding:4px 10px;border-radius:50px}
.vc-badge.active{background:#dcfce7;color:#16a34a}
.vc-badge.overdue{background:#fee2e2;color:#dc2626}
.vc-km{font-size:0.78rem;color:var(--muted);margin-bottom:12px}
.vc-service{display:flex;justify-content:space-between;align-items:center;padding:10px 12px;background:var(--surface);border-radius:8px;font-size:0.76rem;}
.vc-service-name{color:var(--text);font-weight:500}
.due-soon{color:#2563eb;font-weight:600}.overdue-txt{color:#dc2626;font-weight:600}
.mock-section-title{font-size:0.8rem;font-weight:700;color:var(--text);margin-bottom:12px;letter-spacing:.04em;text-transform:uppercase}
.reminder-list{display:flex;flex-direction:column;gap:9px}
.rem-row{display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:10px;border:1px solid var(--border);background:var(--surface);}
.rem-dot{width:9px;height:9px;border-radius:50%;flex-shrink:0}
.rem-dot.red{background:#ef4444;box-shadow:0 0 6px #ef444480}
.rem-dot.amber{background:#f59e0b;box-shadow:0 0 6px #f59e0b80}
.rem-dot.green{background:#22c55e;box-shadow:0 0 6px #22c55e80}
.rem-label{flex:1;font-size:0.8rem;font-weight:500;color:var(--text)}
.rem-vehicle{font-size:0.72rem;color:var(--muted)}
.rem-time{font-size:0.74rem;font-weight:600;color:var(--muted)}
 
/* STATS */
.stats-strip{padding:50px 5%;display:flex;justify-content:center;gap:0;border-top:1px solid var(--border);border-bottom:1px solid var(--border);background:#fff;}
.stat-block{flex:1;max-width:220px;text-align:center;padding:10px 20px;border-right:1px solid var(--border);}
.stat-block:last-child{border-right:none}
.stat-num{font-size:2.2rem;font-weight:800;color:var(--text);letter-spacing:-0.04em;line-height:1}
.stat-num span{color:var(--brand)}
.stat-lbl{font-size:0.8rem;color:var(--muted);margin-top:5px;font-weight:500}
 
/* SECTIONS */
section:not(#hero){padding:90px 5%}
.section-eyebrow{text-align:center;font-size:0.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--brand);margin-bottom:12px;}
.section-h2{font-size:clamp(1.8rem,3vw,2.6rem);font-weight:800;text-align:center;letter-spacing:-0.03em;color:var(--text);margin-bottom:12px;line-height:1.15;}
.section-sub{text-align:center;max-width:520px;margin:0 auto 52px;font-size:0.97rem;color:var(--muted);line-height:1.7;}
 
/* FEATURES */
#features{background:var(--surface)}
.feat-tab-row{display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:44px;}
.ftab{display:flex;align-items:center;gap:7px;padding:10px 20px;border-radius:50px;border:1.5px solid var(--border);background:#fff;cursor:pointer;font-family:inherit;font-size:0.86rem;font-weight:600;color:var(--muted);transition:all .22s;}
.ftab:hover{border-color:var(--brand);color:var(--brand);background:#eff6ff}
.ftab.active{background:var(--brand);border-color:var(--brand);color:#fff;box-shadow:0 4px 14px rgba(37,99,235,0.3)}
.ftab-icon{font-size:15px}
.feat-panels{max-width:960px;margin:0 auto}
.fpanel{display:none;animation:fadein .3s ease}
.fpanel.active{display:grid;grid-template-columns:1fr 1fr;gap:52px;align-items:center}
@keyframes fadein{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
.fpanel-visual{background:linear-gradient(135deg,#1e3a8a 0%,#0e7490 100%);border-radius:20px;min-height:280px;display:flex;align-items:center;justify-content:center;font-size:72px;position:relative;overflow:hidden;box-shadow:0 20px 50px rgba(15,23,42,0.15);}
.fpanel-visual::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 30% 30%,rgba(255,255,255,0.1),transparent 60%);}
.fpanel-body h3{font-size:1.5rem;font-weight:800;letter-spacing:-0.03em;color:var(--text);margin-bottom:14px}
.fpanel-body p{font-size:0.95rem;color:var(--muted);line-height:1.75;margin-bottom:22px}
.fpanel-bullets{list-style:none;display:flex;flex-direction:column;gap:11px}
.fpanel-bullets li{display:flex;align-items:flex-start;gap:10px;font-size:0.9rem;color:#334155;line-height:1.5;}
.bullet-check{width:20px;height:20px;border-radius:50%;background:#dbeafe;color:var(--brand);font-size:0.7rem;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;}
 
/* HOW */
#how{background:#fff}
.steps-container{max-width:700px;margin:0 auto;display:flex;flex-direction:column;gap:12px}
.step-card{border:1.5px solid var(--border);border-radius:14px;overflow:hidden;transition:border-color .3s,box-shadow .3s;cursor:pointer;}
.step-card.open{border-color:var(--brand);box-shadow:0 6px 24px rgba(37,99,235,0.1)}
.step-header{display:flex;align-items:center;gap:16px;padding:20px 22px;background:none;border:none;width:100%;text-align:left;cursor:pointer;font-family:inherit;}
.step-num{width:44px;height:44px;border-radius:50%;flex-shrink:0;border:2px solid var(--border);background:#fff;display:flex;align-items:center;justify-content:center;font-size:1rem;font-weight:800;color:var(--muted);transition:all .3s;}
.step-card.open .step-num{background:var(--brand);border-color:var(--brand);color:#fff;box-shadow:0 0 0 6px rgba(37,99,235,0.15)}
.step-htxt{flex:1}
.step-htitle{font-size:1rem;font-weight:700;color:var(--text)}
.step-hsub{font-size:0.78rem;color:var(--muted);margin-top:2px}
.step-chevron{font-size:1.1rem;color:var(--muted);transition:transform .3s,color .3s}
.step-card.open .step-chevron{transform:rotate(90deg);color:var(--brand)}
.step-body{max-height:0;overflow:hidden;transition:max-height .4s ease,padding .3s;padding:0 22px;}
.step-card.open .step-body{max-height:300px;padding:0 22px 22px}
.step-body-inner{padding-top:16px;border-top:1px solid var(--border);display:flex;gap:20px;align-items:flex-start;}
.step-emoji{font-size:40px;flex-shrink:0}
.step-desc{font-size:0.9rem;color:var(--muted);line-height:1.7;margin-bottom:12px}
.step-chips{display:flex;flex-wrap:wrap;gap:6px}
.chip{background:#eff6ff;border:1px solid #bfdbfe;color:var(--brand);font-size:0.72rem;font-weight:600;padding:3px 10px;border-radius:50px;}
 
/* TESTIMONIALS */
#testimonials{background:var(--surface)}
.testi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;max-width:1060px;margin:0 auto;}
.testi-card{background:#fff;border-radius:16px;padding:28px;border:1.5px solid var(--border);transition:transform .3s,box-shadow .3s,border-color .3s;cursor:pointer;}
.testi-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(15,23,42,0.09);border-color:rgba(37,99,235,0.2)}
.tcard-stars{color:#f59e0b;font-size:1rem;letter-spacing:2px;margin-bottom:14px}
.tcard-text{font-size:0.9rem;color:#475569;line-height:1.72;margin-bottom:20px;font-style:italic}
.tcard-author{display:flex;align-items:center;gap:12px}
.tcard-av{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#dbeafe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:18px;}
.tcard-name{font-weight:700;font-size:0.88rem;color:var(--text)}
.tcard-role{font-size:0.74rem;color:var(--muted)}
 
/* FAQ */
#faq{background:#fff}
.faq-wrap{max-width:700px;margin:0 auto;display:flex;flex-direction:column;gap:8px}
.faq-card{border:1.5px solid var(--border);border-radius:12px;overflow:hidden;transition:border-color .3s,box-shadow .3s;}
.faq-card.open{border-color:var(--brand);box-shadow:0 4px 20px rgba(37,99,235,0.08)}
.faq-q{width:100%;text-align:left;background:none;border:none;padding:18px 20px;cursor:pointer;font-family:inherit;display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:0.95rem;font-weight:600;color:var(--text);}
.faq-icon{width:28px;height:28px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:var(--muted);flex-shrink:0;transition:transform .35s,background .3s,color .3s;}
.faq-card.open .faq-icon{transform:rotate(45deg);background:var(--brand);color:#fff}
.faq-a{max-height:0;overflow:hidden;transition:max-height .4s ease,padding .3s;padding:0 20px;font-size:0.9rem;color:var(--muted);line-height:1.75;}
.faq-card.open .faq-a{max-height:200px;padding:0 20px 20px}
.faq-a-inner{padding-top:12px;border-top:1px solid var(--border)}
 
/* CTA */
#cta{background:linear-gradient(135deg,#1e3a8a 0%,#1d4ed8 50%,#0e7490 100%);text-align:center;position:relative;overflow:hidden;padding:120px 5%;}
#cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 80% at 50% 50%,rgba(255,255,255,0.07),transparent)}
#cta .section-eyebrow{color:rgba(255,255,255,0.7);font-size:0.82rem;letter-spacing:.16em}
#cta .section-h2{color:#fff;position:relative;font-size:clamp(2.6rem,5vw,4rem);letter-spacing:-0.04em;margin-bottom:20px;}
#cta .section-sub{color:rgba(255,255,255,0.68);position:relative;font-size:1.15rem;margin-bottom:48px;max-width:560px;}
.cta-btns{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;position:relative}
.btn-white{background:#fff;color:var(--brand);padding:18px 40px;border-radius:14px;font-family:inherit;font-weight:700;font-size:1.08rem;border:none;cursor:pointer;text-decoration:none;display:inline-block;box-shadow:0 6px 24px rgba(0,0,0,0.18);transition:transform .2s,box-shadow .2s;}
.btn-white:hover{transform:translateY(-3px);box-shadow:0 12px 36px rgba(0,0,0,0.22)}
.btn-white-outline{background:transparent;color:#fff;border:2px solid rgba(255,255,255,0.4);padding:16px 36px;border-radius:14px;font-family:inherit;font-weight:600;font-size:1.08rem;cursor:pointer;text-decoration:none;display:inline-block;transition:border-color .2s,background .2s,transform .2s;}
.btn-white-outline:hover{border-color:#fff;background:rgba(255,255,255,0.1);transform:translateY(-3px)}
.cta-note{margin-top:28px;font-size:0.88rem;color:rgba(255,255,255,0.5);position:relative;letter-spacing:.02em}
 
/* FOOTER */
footer{background:#0f172a;padding:80px 5% 40px;color:rgba(255,255,255,0.5)}
.footer-top{display:grid;grid-template-columns:2.2fr 1fr 1fr 1fr;gap:60px;margin-bottom:60px}
.footer-brand-logo{display:flex;align-items:center;gap:11px;margin-bottom:16px}
.footer-brand-logo-icon{width:40px;height:40px;border-radius:11px;background:linear-gradient(135deg,#2563eb,#06b6d4);display:flex;align-items:center;justify-content:center;}
.footer-brand-name{font-size:1.3rem;font-weight:800;color:#fff;letter-spacing:-0.04em}
.footer-brand-name span{color:#38bdf8}
.footer-tagline{font-size:0.9rem;line-height:1.72;max-width:280px;margin-bottom:24px}
.footer-social{display:flex;gap:10px}
.social-btn{width:38px;height:38px;border-radius:9px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.5);font-size:0.9rem;text-decoration:none;transition:background .2s,color .2s,border-color .2s;}
.social-btn:hover{background:rgba(56,189,248,0.15);color:#38bdf8;border-color:#38bdf8}
.footer-col h4{font-size:0.82rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.1em;margin-bottom:18px}
.footer-col ul{list-style:none}
.footer-col li{margin-bottom:12px}
.footer-col a{color:rgba(255,255,255,0.45);text-decoration:none;font-size:0.9rem;transition:color .2s}
.footer-col a:hover{color:#38bdf8}
.badge-new{display:inline-block;background:#1d4ed8;color:#bfdbfe;font-size:0.6rem;font-weight:700;padding:2px 7px;border-radius:50px;margin-left:6px;vertical-align:middle;letter-spacing:.05em;}
.footer-newsletter{margin-top:8px}
.footer-newsletter p{font-size:0.84rem;margin-bottom:12px;color:rgba(255,255,255,0.5)}
.footer-newsletter-form{display:flex;gap:8px}
.footer-newsletter-input{flex:1;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.12);border-radius:9px;padding:10px 14px;color:#fff;font-family:inherit;font-size:0.84rem;outline:none;transition:border-color .2s;}
.footer-newsletter-input::placeholder{color:rgba(255,255,255,0.3)}
.footer-newsletter-input:focus{border-color:#38bdf8}
.footer-newsletter-btn{background:var(--brand);color:#fff;border:none;cursor:pointer;padding:10px 18px;border-radius:9px;font-family:inherit;font-size:0.82rem;font-weight:600;white-space:nowrap;transition:background .2s;}
.footer-newsletter-btn:hover{background:#1d4ed8}
.footer-divider{height:1px;background:rgba(255,255,255,0.08);margin-bottom:28px}
.footer-bottom{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;}
.footer-copy{font-size:0.82rem}
.footer-links-bottom{display:flex;gap:20px}
.footer-links-bottom a{font-size:0.8rem;color:rgba(255,255,255,0.3);text-decoration:none;transition:color .2s}
.footer-links-bottom a:hover{color:#38bdf8}
 
/* REVEAL */
.reveal{opacity:0;transform:translateY(20px);transition:opacity .65s ease,transform .65s ease}
.reveal.visible{opacity:1;transform:none}
 
/* RESPONSIVE */
@media(max-width:1024px){.footer-top{grid-template-columns:1fr 1fr}.mock-sidebar{display:none}.vehicle-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){h1{font-size:2.6rem}.hero-sub{font-size:1rem}.fpanel.active{grid-template-columns:1fr}.fpanel-visual{min-height:160px;font-size:50px}.stats-strip{flex-wrap:wrap}.stat-block{border-right:none;border-bottom:1px solid var(--border);min-width:140px}.stat-block:last-child{border-bottom:none}.footer-top{grid-template-columns:1fr 1fr}.testi-grid{grid-template-columns:1fr}.vehicle-grid{grid-template-columns:1fr}#cta .section-h2{font-size:2.2rem}}
@media(max-width:640px){nav{padding:0 4%}.nav-links{display:none}.ftab{padding:8px 14px;font-size:0.8rem}#hero{padding:110px 4% 70px}section:not(#hero){padding:70px 4%}#cta{padding:80px 4%}footer{padding:60px 4% 32px}.footer-top{grid-template-columns:1fr}.footer-newsletter-form{flex-direction:column}h1{font-size:2.2rem}}
</style>
</head>
<body>
 
{{-- ═══ NAV ═══ --}}
<nav id="navbar">
  <a href="{{ url('/') }}" class="nav-logo">
    <div class="nav-logo-icon">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
        <path d="M5 11L6.5 6.5C6.8 5.6 7.6 5 8.6 5H15.4C16.4 5 17.2 5.6 17.5 6.5L19 11" stroke="white" stroke-width="1.6" stroke-linecap="round"/>
        <rect x="2" y="11" width="20" height="7" rx="2" stroke="white" stroke-width="1.6"/>
        <circle cx="7" cy="18" r="2" fill="white"/>
        <circle cx="17" cy="18" r="2" fill="white"/>
        <path d="M2 14H22" stroke="white" stroke-width="1.6"/>
        <path d="M9 11H15" stroke="white" stroke-width="1.4" stroke-linecap="round"/>
      </svg>
    </div>
    <span class="nav-logo-text">Service<span>Mate</span></span>
  </a>
  <ul class="nav-links">
    <li><a href="#features">Features</a></li>
    <li><a href="#how">How It Works</a></li>
    <li><a href="#testimonials">Testimonials</a></li>
    <li><a href="#faq">FAQ</a></li>
 
    {{-- Jika sudah login, tampilkan link ke dashboard --}}
    @auth
      <li><a href="{{ route('dashboard') }}" class="nav-btn-ghost">Dashboard</a></li>
      <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button type="submit" class="nav-btn-solid" style="border:none;cursor:pointer;font-family:inherit">Logout</button>
      </form>
    @else
      {{-- Belum login: tampilkan Log In dan Get Started --}}
      <li><a href="{{ route('login') }}" class="nav-btn-ghost">Log In</a></li>
      <li><a href="{{ route('register') }}" class="nav-btn-solid">Get Started</a></li>
    @endauth
  </ul>
</nav>
 
{{-- ═══ HERO ═══ --}}
<section id="hero">
  <div class="hero-glow"></div>
  <div class="hero-badge">
    <span class="hero-badge-dot"></span>
    {{ $content['hero_badge'] ?? 'Never miss a service again' }}
  </div>
  <h1>{{ $content['hero_title'] ?? 'Keep Your Vehicle Running Smoothly' }}</h1>
  <p class="hero-sub">{{ $content['hero_subtitle'] ?? 'ServiceMate mengingatkan jadwal servis berdasarkan waktu & kilometer.' }}</p>
  <div class="hero-btns">
    {{-- Tombol utama → ke register --}}
    <a href="{{ route('register') }}" class="btn-blue">Start Free Trial &nbsp;→</a>
    <a href="#how" class="btn-outline">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5,3 19,12 5,21"/></svg>
      Watch Demo
    </a>
  </div>
  <div class="hero-trust">
    <div class="trust-item">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3"><polyline points="20,6 9,17 4,12"/></svg>
      Free 14-day trial
    </div>
    <div class="trust-item">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3"><polyline points="20,6 9,17 4,12"/></svg>
      No credit card required
    </div>
    <div class="trust-item">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3"><polyline points="20,6 9,17 4,12"/></svg>
      Cancel anytime
    </div>
  </div>
 
  {{-- Dashboard Mockup --}}
  <div class="mockup-wrap reveal">
    <div class="mockup-bar">
      <div class="mock-dots"><span class="r"></span><span class="y"></span><span class="g"></span></div>
      <div class="mock-url">app.servicemate.id/dashboard</div>
    </div>
    <div class="mockup-body">
      <div class="mock-layout">
        <div class="mock-sidebar">
          <div class="mock-brand">
            <div class="mock-brand-icon">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 11L6.5 6.5C6.8 5.6 7.6 5 8.6 5H15.4C16.4 5 17.2 5.6 17.5 6.5L19 11" stroke="white" stroke-width="1.8" stroke-linecap="round"/><rect x="2" y="11" width="20" height="7" rx="2" stroke="white" stroke-width="1.8"/><circle cx="7" cy="18" r="1.5" fill="white"/><circle cx="17" cy="18" r="1.5" fill="white"/><path d="M2 14H22" stroke="white" stroke-width="1.8"/></svg>
            </div>
            <span class="mock-brand-name">ServiceMate</span>
          </div>
          <div class="mock-nav-item active"><span class="mock-nav-icon">🚗</span> My Vehicles</div>
          <div class="mock-nav-item"><span class="mock-nav-icon">📅</span> Schedule</div>
          <div class="mock-nav-item"><span class="mock-nav-icon">🔔</span> Reminders</div>
          <div class="mock-nav-item"><span class="mock-nav-icon">📋</span> History</div>
          <div class="mock-nav-item"><span class="mock-nav-icon">📍</span> Find Bengkel</div>
          <div class="mock-nav-item"><span class="mock-nav-icon">⚙️</span> Settings</div>
        </div>
        <div class="mock-main">
          <div class="mock-topbar">
            <span class="mock-title">My Vehicles</span>
            <button class="mock-add-btn">+ Add Vehicle</button>
          </div>
          <div class="vehicle-grid">
            <div class="vehicle-card">
              <div class="vc-top"><span class="vc-name">2022 Honda Accord</span><span class="vc-badge active">Active</span></div>
              <div class="vc-km">45,230 miles</div>
              <div class="vc-service"><span class="vc-service-name">🛢️ Oil Change</span><span class="due-soon">Due in 500 mi</span></div>
            </div>
            <div class="vehicle-card">
              <div class="vc-top"><span class="vc-name">2019 Toyota Avanza</span><span class="vc-badge overdue">Overdue</span></div>
              <div class="vc-km">78,450 km</div>
              <div class="vc-service"><span class="vc-service-name">🔧 Brake Inspection</span><span class="overdue-txt">Overdue</span></div>
            </div>
          </div>
          <div class="mock-section-title">Upcoming Reminders</div>
          <div class="reminder-list">
            <div class="rem-row"><span class="rem-dot red"></span><span class="rem-label">Ganti Oli Mesin <span class="rem-vehicle">· Honda Accord</span></span><span class="rem-time">3 hari lagi</span></div>
            <div class="rem-row"><span class="rem-dot amber"></span><span class="rem-label">Cek Filter Udara <span class="rem-vehicle">· Toyota Avanza</span></span><span class="rem-time">18 hari lagi</span></div>
            <div class="rem-row"><span class="rem-dot green"></span><span class="rem-label">Rotasi Ban <span class="rem-vehicle">· Honda Accord</span></span><span class="rem-time">45 hari lagi</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 
{{-- ═══ STATS ═══ --}}
<div class="stats-strip">
  <div class="stat-block reveal"><div class="stat-num">12<span>K+</span></div><div class="stat-lbl">Pengguna Aktif</div></div>
  <div class="stat-block reveal"><div class="stat-num">98<span>%</span></div><div class="stat-lbl">Kepuasan Pengguna</div></div>
  <div class="stat-block reveal"><div class="stat-num">4.9<span>★</span></div><div class="stat-lbl">Rating Aplikasi</div></div>
  <div class="stat-block reveal"><div class="stat-num">50<span>K+</span></div><div class="stat-lbl">Servis Tercatat</div></div>
</div>
 
{{-- ═══ FEATURES ═══ --}}
<section id="features">
  <div class="section-eyebrow">Features</div>
  <h2 class="section-h2">Semua yang Kamu Butuhkan</h2>
  <p class="section-sub">Klik setiap fitur untuk melihat detail lengkap dan manfaatnya.</p>
  <div class="feat-tab-row">
    <button class="ftab active" onclick="switchFeat(0)"><span class="ftab-icon">⏰</span> Pengingat Servis</button>
    <button class="ftab" onclick="switchFeat(1)"><span class="ftab-icon">📊</span> Analisis Kondisi</button>
    <button class="ftab" onclick="switchFeat(2)"><span class="ftab-icon">🔔</span> Notifikasi</button>
    <button class="ftab" onclick="switchFeat(3)"><span class="ftab-icon">📋</span> Riwayat Servis</button>
    <button class="ftab" onclick="switchFeat(4)"><span class="ftab-icon">🚗</span> Multi Kendaraan</button>
    <button class="ftab" onclick="switchFeat(5)"><span class="ftab-icon">📍</span> Cari Bengkel</button>
  </div>
  <div class="feat-panels">
    <div class="fpanel active">
      <div class="fpanel-visual">⏰</div>
      <div class="fpanel-body"><h3>Pengingat Servis Otomatis</h3><p>Sistem pengingat cerdas berdasarkan waktu dan kilometer. ServiceMate mengatur jadwal perawatan kendaraanmu secara otomatis sesuai panduan pabrikan.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Pengingat berdasarkan interval waktu & KM</li><li><span class="bullet-check">✓</span>Kustomisasi jadwal sesuai kebutuhan</li><li><span class="bullet-check">✓</span>Sinkronisasi otomatis dengan odometer</li><li><span class="bullet-check">✓</span>Berlaku untuk oli, ban, rem, AC, dan lainnya</li></ul></div>
    </div>
    <div class="fpanel">
      <div class="fpanel-visual">📊</div>
      <div class="fpanel-body"><h3>Analisis Kondisi Kendaraan</h3><p>Ceritakan gejala yang kamu rasakan dan sistem AI ServiceMate akan menganalisis kemungkinan masalah serta memberikan rekomendasi tindakan yang tepat.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Deteksi masalah dari deskripsi gejala</li><li><span class="bullet-check">✓</span>Database ribuan masalah kendaraan umum</li><li><span class="bullet-check">✓</span>Saran prioritas urgensi tindakan</li><li><span class="bullet-check">✓</span>Laporan kondisi kendaraan bulanan</li></ul></div>
    </div>
    <div class="fpanel">
      <div class="fpanel-visual">🔔</div>
      <div class="fpanel-body"><h3>Notifikasi Pintar Multi-Channel</h3><p>Terima pengingat tepat waktu sebelum jadwal servis jatuh tempo melalui berbagai saluran agar kamu tidak pernah terlewat.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Notifikasi via email, browser push & SMS</li><li><span class="bullet-check">✓</span>Pengingat H-7, H-3, dan H-1</li><li><span class="bullet-check">✓</span>Alert darurat kondisi kritis</li><li><span class="bullet-check">✓</span>Atur jam & frekuensi sesuai preferensi</li></ul></div>
    </div>
    <div class="fpanel">
      <div class="fpanel-visual">📋</div>
      <div class="fpanel-body"><h3>Riwayat Servis Lengkap</h3><p>Simpan semua catatan servis dalam satu tempat yang rapi. Ideal untuk memantau biaya perawatan dan mempersiapkan saat menjual kendaraan.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Catat jenis servis, biaya & bengkel</li><li><span class="bullet-check">✓</span>Upload foto struk sebagai bukti</li><li><span class="bullet-check">✓</span>Grafik pengeluaran per bulan & tahun</li><li><span class="bullet-check">✓</span>Export riwayat ke PDF</li></ul></div>
    </div>
    <div class="fpanel">
      <div class="fpanel-visual">🚗</div>
      <div class="fpanel-body"><h3>Kelola Banyak Kendaraan</h3><p>Tambahkan semua kendaraan dalam satu akun. Ideal untuk keluarga atau pengusaha dengan armada kendaraan operasional.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Tidak terbatas jumlah kendaraan (premium)</li><li><span class="bullet-check">✓</span>Dashboard terpusat semua kendaraan</li><li><span class="bullet-check">✓</span>Profil terpisah per kendaraan</li><li><span class="bullet-check">✓</span>Mendukung mobil, motor & kendaraan niaga</li></ul></div>
    </div>
    <div class="fpanel">
      <div class="fpanel-visual">📍</div>
      <div class="fpanel-body"><h3>Rekomendasi Bengkel Terpercaya</h3><p>Temukan bengkel terbaik di sekitarmu berdasarkan lokasi, spesialisasi, dan rating dari pengguna lain. Booking langsung dari aplikasi.</p><ul class="fpanel-bullets"><li><span class="bullet-check">✓</span>Direktori bengkel terverifikasi</li><li><span class="bullet-check">✓</span>Filter berdasarkan merek & jenis servis</li><li><span class="bullet-check">✓</span>Rating & ulasan komunitas pengguna</li><li><span class="bullet-check">✓</span>Booking jadwal servis online</li></ul></div>
    </div>
  </div>
</section>
 
{{-- ═══ HOW IT WORKS ═══ --}}
<section id="how">
  <div class="section-eyebrow">How It Works</div>
  <h2 class="section-h2">Mulai dalam 3 Langkah Mudah</h2>
  <p class="section-sub">Klik setiap langkah untuk melihat detailnya.</p>
  <div class="steps-container reveal">
    <div class="step-card open">
      <button class="step-header" onclick="toggleStep(0)">
        <div class="step-num">1</div>
        <div class="step-htxt"><div class="step-htitle">Daftarkan Kendaraanmu</div><div class="step-hsub">Hanya 2 menit · Gratis selamanya</div></div>
        <span class="step-chevron">›</span>
      </button>
      <div class="step-body"><div class="step-body-inner"><div class="step-emoji">🚗</div><div><p class="step-desc">Buat akun gratis, lalu masukkan data kendaraanmu: merek, model, tahun, dan kilometer saat ini. ServiceMate otomatis mengenali profil perawatan yang sesuai.</p><div class="step-chips"><span class="chip">Merek & Model</span><span class="chip">Tahun Pembuatan</span><span class="chip">Odometer</span><span class="chip">Jenis BBM</span></div></div></div></div>
    </div>
    <div class="step-card">
      <button class="step-header" onclick="toggleStep(1)">
        <div class="step-num">2</div>
        <div class="step-htxt"><div class="step-htitle">Atur Jadwal Servis</div><div class="step-hsub">Otomatis atau manual · Fleksibel</div></div>
        <span class="step-chevron">›</span>
      </button>
      <div class="step-body"><div class="step-body-inner"><div class="step-emoji">📅</div><div><p class="step-desc">ServiceMate menyarankan jadwal servis berdasarkan tipe kendaraan dan panduan pabrikan. Kamu juga bisa menyesuaikan jadwal secara manual.</p><div class="step-chips"><span class="chip">Jadwal Otomatis</span><span class="chip">Kustomisasi Manual</span><span class="chip">Multi Komponen</span></div></div></div></div>
    </div>
    <div class="step-card">
      <button class="step-header" onclick="toggleStep(2)">
        <div class="step-num">3</div>
        <div class="step-htxt"><div class="step-htitle">Terima Pengingat & Pantau Kondisi</div><div class="step-hsub">Notifikasi pintar · Dashboard real-time</div></div>
        <span class="step-chevron">›</span>
      </button>
      <div class="step-body"><div class="step-body-inner"><div class="step-emoji">🔔</div><div><p class="step-desc">Nikmati notifikasi tepat waktu dan pantau kondisi semua kendaraan dari dashboard yang bersih dan intuitif. Tidak perlu khawatir lagi!</p><div class="step-chips"><span class="chip">Push Notification</span><span class="chip">Email Reminder</span><span class="chip">Dashboard Live</span></div></div></div></div>
    </div>
  </div>
</section>
 
{{-- ═══ TESTIMONIALS ═══ --}}
<section id="testimonials">
  <div class="section-eyebrow">Testimonials</div>
  <h2 class="section-h2">Dipercaya Ribuan Pemilik Kendaraan</h2>
  <p class="section-sub">Bergabunglah dengan komunitas pengguna ServiceMate yang kendaraannya selalu terawat.</p>
  <div class="testi-grid">
    <div class="testi-card reveal"><div class="tcard-stars">★★★★★</div><p class="tcard-text">"Sebelum pakai ServiceMate, sering lupa ganti oli sampai mesin bermasalah. Sekarang tidak pernah terlambat servis lagi. Mudah banget dipakai!"</p><div class="tcard-author"><div class="tcard-av">👨</div><div><div class="tcard-name">Budi Hartono</div><div class="tcard-role">Toyota Avanza · Semarang</div></div></div></div>
    <div class="testi-card reveal"><div class="tcard-stars">★★★★★</div><p class="tcard-text">"Fitur analisis gejala kendaraan luar biasa! Waktu mobil saya getaran aneh, ServiceMate langsung kasih saran yang tepat. Ternyata masalah di mounting mesin."</p><div class="tcard-author"><div class="tcard-av">👩</div><div><div class="tcard-name">Sari Dewi</div><div class="tcard-role">Honda HR-V · Yogyakarta</div></div></div></div>
    <div class="testi-card reveal"><div class="tcard-stars">★★★★☆</div><p class="tcard-text">"Saya pakai buat kelola 3 kendaraan operasional usaha. Dashboard-nya sangat membantu, semua info kendaraan langsung keliatan. Hemat waktu banget!"</p><div class="tcard-author"><div class="tcard-av">👨‍💼</div><div><div class="tcard-name">Denny Prasetyo</div><div class="tcard-role">Pemilik Usaha · Solo</div></div></div></div>
  </div>
</section>
 
{{-- ═══ FAQ ═══ --}}
<section id="faq">
  <div class="section-eyebrow">FAQ</div>
  <h2 class="section-h2">Pertanyaan yang Sering Ditanyakan</h2>
  <p class="section-sub">Klik pertanyaan untuk melihat jawabannya.</p>
  <div class="faq-wrap">
    <div class="faq-card open"><button class="faq-q" onclick="toggleFaq(this)">Apakah ServiceMate benar-benar gratis?<span class="faq-icon">+</span></button><div class="faq-a"><div class="faq-a-inner">Ya! Paket gratis mencakup pengingat servis untuk 1 kendaraan, riwayat servis, dan notifikasi email selamanya. Fitur lengkap tersedia di paket Premium mulai Rp 29.000/bulan.</div></div></div>
    <div class="faq-card"><button class="faq-q" onclick="toggleFaq(this)">Bagaimana cara kerja analisis kondisi kendaraan?<span class="faq-icon">+</span></button><div class="faq-a"><div class="faq-a-inner">Deskripsikan gejala yang kamu rasakan seperti suara aneh atau getaran. Sistem AI kami mencocokkan dengan database ribuan masalah kendaraan, lalu memberikan kemungkinan penyebab dan saran tindakan.</div></div></div>
    <div class="faq-card"><button class="faq-q" onclick="toggleFaq(this)">Apakah data kendaraan saya aman?<span class="faq-icon">+</span></button><div class="faq-a"><div class="faq-a-inner">Semua data dienkripsi dengan AES-256 dan tidak pernah dibagikan ke pihak ketiga. Server berlokasi di Indonesia dan mematuhi regulasi perlindungan data pribadi.</div></div></div>
    <div class="faq-card"><button class="faq-q" onclick="toggleFaq(this)">Bisa dipakai untuk motor juga?<span class="faq-icon">+</span></button><div class="faq-a"><div class="faq-a-inner">Tentu! ServiceMate mendukung semua jenis kendaraan: sepeda motor, mobil, SUV, MPV, truk ringan, hingga kendaraan niaga. Jadwal servis disesuaikan otomatis per tipe kendaraan.</div></div></div>
    <div class="faq-card"><button class="faq-q" onclick="toggleFaq(this)">Apakah tersedia sebagai aplikasi mobile?<span class="faq-icon">+</span></button><div class="faq-a"><div class="faq-a-inner">ServiceMate tersedia sebagai web app yang bisa diakses dari semua perangkat. Aplikasi iOS dan Android sedang dikembangkan — daftar sekarang untuk dapat akses beta gratis!</div></div></div>
  </div>
</section>
 
{{-- ═══ CTA ═══ --}}
<section id="cta">
  <div class="section-eyebrow">Get Started</div>
  <h2 class="section-h2">Kendaraanmu Layak Mendapat<br>Perawatan Terbaik</h2>
  <p class="section-sub">Bergabunglah dengan 12.000+ pengguna. Gratis untuk memulai, tidak perlu kartu kredit.</p>
  <div class="cta-btns">
    <a href="{{ route('register') }}" class="btn-white">🚀 Start Free Trial →</a>
    <a href="#features" class="btn-white-outline">Pelajari Fitur Lebih Lanjut</a>
  </div>
  <p class="cta-note">✓ Free 14-day trial &nbsp;·&nbsp; ✓ No credit card &nbsp;·&nbsp; ✓ Cancel anytime</p>
</section>
 
{{-- ═══ FOOTER ═══ --}}
<footer>
  <div class="footer-top">
    <div>
      <div class="footer-brand-logo">
        <div class="footer-brand-logo-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M5 11L6.5 6.5C6.8 5.6 7.6 5 8.6 5H15.4C16.4 5 17.2 5.6 17.5 6.5L19 11" stroke="white" stroke-width="1.8" stroke-linecap="round"/><rect x="2" y="11" width="20" height="7" rx="2" stroke="white" stroke-width="1.8"/><circle cx="7" cy="18" r="1.8" fill="white"/><circle cx="17" cy="18" r="1.8" fill="white"/><path d="M2 14H22" stroke="white" stroke-width="1.8"/></svg>
        </div>
        <span class="footer-brand-name">Service<span>Mate</span></span>
      </div>
      <p class="footer-tagline">Asisten digital terpercaya untuk menjaga kendaraanmu selalu dalam kondisi prima. Dibuat dengan ❤️ untuk pengguna Indonesia.</p>
      <div class="footer-social">
        <a class="social-btn" href="#" title="Instagram">📷</a>
        <a class="social-btn" href="#" title="Twitter/X">𝕏</a>
        <a class="social-btn" href="#" title="YouTube">▶</a>
        <a class="social-btn" href="#" title="LinkedIn">in</a>
      </div>
      <div class="footer-newsletter" style="margin-top:24px">
        <p>Dapatkan update & tips perawatan kendaraan:</p>
        <div class="footer-newsletter-form">
          <input class="footer-newsletter-input" type="email" placeholder="Email kamu...">
          <button class="footer-newsletter-btn">Subscribe</button>
        </div>
      </div>
    </div>
    <div class="footer-col">
      <h4>Product</h4>
      <ul>
        <li><a href="#features">Features</a></li>
        <li><a href="#">Pricing</a></li>
        <li><a href="{{ route('register') }}">Demo</a></li>
        <li><a href="#">Changelog <span class="badge-new">NEW</span></a></li>
        <li><a href="#">Mobile App</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Rita Rani</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Support</h4>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
        <li><a href="#">Cookie Policy</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-divider"></div>
  <div class="footer-bottom">
  <span class="footer-copy">{{ $content['footer_text'] ?? '© ' . date('Y') . ' ServiceMate · Made with ❤️ for Indonesia' }}</span>
    <div class="footer-links-bottom">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">Sitemap</a>
    </div>
  </div>
</footer>
 
<script>
function switchFeat(i){
  document.querySelectorAll('.ftab').forEach((t,j)=>t.classList.toggle('active',j===i));
  document.querySelectorAll('.fpanel').forEach((p,j)=>p.classList.toggle('active',j===i));
}
function toggleStep(i){
  const cards=document.querySelectorAll('.step-card');
  cards.forEach((c,j)=>{ if(j===i) c.classList.toggle('open'); else c.classList.remove('open'); });
}
function toggleFaq(btn){
  const card=btn.parentElement;
  const isOpen=card.classList.contains('open');
  document.querySelectorAll('.faq-card').forEach(c=>c.classList.remove('open'));
  if(!isOpen) card.classList.add('open');
}
const obs=new IntersectionObserver(entries=>{
  entries.forEach((e,i)=>{ if(e.isIntersecting) setTimeout(()=>e.target.classList.add('visible'),i*80); });
},{threshold:0.1});
document.querySelectorAll('.reveal').forEach(r=>obs.observe(r));
window.addEventListener('scroll',()=>{
  document.getElementById('navbar').classList.toggle('scrolled',window.scrollY>20);
});
</script>
</body>
</html>

