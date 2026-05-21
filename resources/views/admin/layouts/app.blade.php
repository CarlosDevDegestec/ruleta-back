<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Ruleta de Premios</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #111; --bg2: #1a1a1a; --bg3: #222; --border: #333;
            --text: #f0f0f0; --text-muted: #888;
            --accent: #FFB71B; --accent-dark: #e0a015;
            --danger: #e53935; --success: #43a047;
            --sidebar-w: 220px;
        }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
        .sidebar { width: var(--sidebar-w); background: var(--bg2); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100; }
        .sidebar-logo { padding: 24px 20px; font-size: 1.1rem; font-weight: 700; color: var(--accent); border-bottom: 1px solid var(--border); }
        .sidebar-nav { flex: 1; padding: 16px 0; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: var(--text-muted); text-decoration: none; font-size: .93rem; transition: all .15s; }
        .nav-link:hover, .nav-link.active { color: var(--accent); background: rgba(255,183,27,.07); }
        .nav-link svg { width: 18px; height: 18px; flex-shrink: 0; }
        .topbar { position: fixed; top: 0; left: var(--sidebar-w); right: 0; height: 60px; background: var(--bg2); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; z-index: 99; }
        .topbar-title { font-size: 1rem; font-weight: 600; }
        .btn-logout { background: transparent; border: 1px solid var(--border); color: var(--text-muted); padding: 7px 16px; border-radius: 6px; cursor: pointer; font-size: .875rem; transition: all .15s; }
        .btn-logout:hover { border-color: var(--danger); color: var(--danger); }
        .main { margin-left: var(--sidebar-w); padding-top: 60px; flex: 1; }
        .content { padding: 28px; }
        .page-header { margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .page-title { font-size: 1.4rem; font-weight: 700; }
        .card { background: var(--bg2); border: 1px solid var(--border); border-radius: 10px; padding: 24px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg3); color: var(--text-muted); font-size: .78rem; text-transform: uppercase; letter-spacing: .05em; padding: 11px 14px; text-align: left; }
        td { padding: 12px 14px; border-bottom: 1px solid var(--border); font-size: .9rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,.02); }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 7px; font-size: .875rem; font-weight: 500; cursor: pointer; border: none; text-decoration: none; transition: all .15s; }
        .btn-primary { background: var(--accent); color: #111; }
        .btn-primary:hover { background: var(--accent-dark); }
        .btn-sm { padding: 5px 12px; font-size: .8rem; }
        .btn-edit { background: var(--bg3); color: var(--text); border: 1px solid var(--border); }
        .btn-edit:hover { border-color: var(--accent); color: var(--accent); }
        .btn-danger { background: transparent; color: var(--danger); border: 1px solid transparent; padding: 5px 10px; border-radius: 6px; font-size: .8rem; cursor: pointer; transition: all .15s; }
        .btn-danger:hover { background: rgba(229,57,53,.12); border-color: var(--danger); }
        .form-grid { display: grid; gap: 18px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        label { font-size: .85rem; color: var(--text-muted); }
        input[type="text"], input[type="number"], input[type="email"], input[type="password"], select, textarea { background: var(--bg3); border: 1px solid var(--border); color: var(--text); padding: 10px 13px; border-radius: 7px; font-size: .9rem; outline: none; width: 100%; transition: border-color .15s; }
        input:focus, select:focus, textarea:focus { border-color: var(--accent); }
        select option { background: var(--bg3); }
        .checkbox-row { display: flex; align-items: center; gap: 10px; }
        input[type="checkbox"] { width: 17px; height: 17px; accent-color: var(--accent); cursor: pointer; }
        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 99px; font-size: .75rem; font-weight: 600; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: .9rem; }
        .alert-success { background: rgba(67,160,71,.15); border: 1px solid rgba(67,160,71,.3); color: #81c784; }
        .alert-error { background: rgba(229,57,53,.15); border: 1px solid rgba(229,57,53,.3); color: #ef9a9a; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; }
        .stat-card { background: var(--bg2); border: 1px solid var(--border); border-radius: 10px; padding: 20px 24px; }
        .stat-value { font-size: 2.2rem; font-weight: 700; color: var(--accent); }
        .stat-label { font-size: .85rem; color: var(--text-muted); margin-top: 4px; }
        .status-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; }
        .status-dot.on { background: var(--success); }
        .status-dot.off { background: var(--text-muted); }
        .form-actions { display: flex; gap: 10px; margin-top: 4px; }
        .text-muted { color: var(--text-muted); }
        .empty-state { text-align: center; padding: 48px; color: var(--text-muted); }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">🎡 Ruleta Admin</div>
    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.prizes.index') }}" class="nav-link {{ request()->routeIs('admin.prizes*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
            Premios
        </a>
        <a href="{{ route('admin.questions.index') }}" class="nav-link {{ request()->routeIs('admin.questions*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Preguntas
        </a>
        <a href="{{ route('admin.claims.index') }}" class="nav-link {{ request()->routeIs('admin.claims*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Reclamaciones
        </a>
        <a href="{{ route('admin.config.edit') }}" class="nav-link {{ request()->routeIs('admin.config*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Configuración
        </a>
    </nav>
</aside>
<div class="main">
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', 'Panel de Administración')</span>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin:0">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
        </form>
    </header>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
