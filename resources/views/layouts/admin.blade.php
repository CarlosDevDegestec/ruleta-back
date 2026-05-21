<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','Admin') — Ruleta de Premios</title>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--bg:#111;--surface:#1a1a1a;--border:#2a2a2a;--accent:#FFB71B;--accent-hover:#e6a318;--text:#e0e0e0;--muted:#888;--danger:#ef4444;--success:#22c55e}
body{background:var(--bg);color:var(--text);font-family:'Segoe UI',system-ui,sans-serif;display:flex;min-height:100vh}
.sidebar{width:240px;background:var(--surface);border-right:1px solid var(--border);display:flex;flex-direction:column;flex-shrink:0}
.sidebar-brand{padding:24px 20px;border-bottom:1px solid var(--border)}
.sidebar-brand h1{font-size:1rem;font-weight:700;color:var(--accent)}
.sidebar-brand p{font-size:.75rem;color:var(--muted);margin-top:2px}
.sidebar-nav{flex:1;padding:12px 0}
.sidebar-nav a{display:flex;align-items:center;gap:10px;padding:11px 20px;color:var(--muted);text-decoration:none;font-size:.875rem;transition:all .15s;border-left:3px solid transparent}
.sidebar-nav a:hover,.sidebar-nav a.active{color:var(--accent);background:rgba(255,183,27,.07);border-left-color:var(--accent)}
.layout-main{flex:1;display:flex;flex-direction:column;overflow:hidden}
.navbar{height:56px;background:var(--surface);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 24px}
.navbar-title{font-weight:600;font-size:1rem}
.btn-logout{background:transparent;border:1px solid var(--border);color:var(--muted);padding:6px 14px;border-radius:6px;cursor:pointer;font-size:.8rem;transition:all .15s}
.btn-logout:hover{border-color:var(--danger);color:var(--danger)}
.content{flex:1;overflow-y:auto;padding:28px 32px}
.card{background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:24px}
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px}
.page-header h2{font-size:1.25rem;font-weight:600}
.btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:7px;font-size:.875rem;font-weight:500;text-decoration:none;cursor:pointer;border:none;transition:all .15s}
.btn-primary{background:var(--accent);color:#111}.btn-primary:hover{background:var(--accent-hover)}
.btn-secondary{background:var(--border);color:var(--text)}.btn-secondary:hover{background:#333}
.btn-danger{background:transparent;border:1px solid var(--danger);color:var(--danger);padding:6px 12px;font-size:.8rem;border-radius:6px;cursor:pointer}
.btn-danger:hover{background:var(--danger);color:white}
.btn-edit{background:transparent;border:1px solid #3b82f6;color:#3b82f6;padding:6px 12px;font-size:.8rem;border-radius:6px;text-decoration:none;display:inline-block}
.btn-edit:hover{background:#3b82f6;color:white}
table{width:100%;border-collapse:collapse}
th{text-align:left;padding:12px 14px;font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);border-bottom:1px solid var(--border)}
td{padding:13px 14px;font-size:.875rem;border-bottom:1px solid var(--border);vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:rgba(255,255,255,.02)}
.badge{display:inline-block;padding:3px 10px;border-radius:99px;font-size:.72rem;font-weight:600;color:white}
.badge-active{background:var(--success)}.badge-inactive{background:#444;color:var(--muted)}
.form-group{margin-bottom:20px}
label{display:block;font-size:.875rem;font-weight:500;margin-bottom:7px}
input[type=text],input[type=email],input[type=number],input[type=password],select,textarea{width:100%;background:var(--bg);border:1px solid var(--border);border-radius:7px;color:var(--text);padding:10px 13px;font-size:.875rem;outline:none;transition:border-color .15s}
input:focus,select:focus,textarea:focus{border-color:var(--accent)}
.form-hint{font-size:.75rem;color:var(--muted);margin-top:5px}
.checkbox-row{display:flex;align-items:center;gap:10px}
.checkbox-row input[type=checkbox]{width:17px;height:17px;accent-color:var(--accent);flex-shrink:0}
.form-actions{display:flex;gap:12px;margin-top:28px}
.alert{padding:12px 16px;border-radius:7px;margin-bottom:20px;font-size:.875rem}
.alert-success{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);color:var(--success)}
.alert-error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:var(--danger)}
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:28px}
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:22px}
.stat-label{font-size:.8rem;color:var(--muted);text-transform:uppercase;letter-spacing:.5px}
.stat-value{font-size:2rem;font-weight:700;color:var(--accent);margin-top:6px}
.actions-cell{display:flex;gap:8px;align-items:center}
.max-w{max-width:600px}
</style>
</head>
<body>
<aside class="sidebar">
  <div class="sidebar-brand"><h1>🎡 Ruleta Admin</h1><p>Panel de control</p></div>
  <nav class="sidebar-nav">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a>
    <a href="{{ route('admin.prizes.index') }}" class="{{ request()->routeIs('admin.prizes*') ? 'active' : '' }}">🏆 Premios</a>
    <a href="{{ route('admin.questions.index') }}" class="{{ request()->routeIs('admin.questions*') ? 'active' : '' }}">❓ Preguntas</a>
    <a href="{{ route('admin.claims.index') }}" class="{{ request()->routeIs('admin.claims*') ? 'active' : '' }}">📋 Reclamaciones</a>
    <a href="{{ route('admin.config.edit') }}" class="{{ request()->routeIs('admin.config*') ? 'active' : '' }}">⚙️ Configuración</a>
  </nav>
</aside>
<div class="layout-main">
  <header class="navbar">
    <span class="navbar-title">@yield('page-title','Panel Admin')</span>
    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
      @csrf
      <button type="submit" class="btn-logout">Cerrar Sesión</button>
    </form>
  </header>
  <main class="content">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-error">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    @yield('content')
  </main>
</div>
</body>
</html>