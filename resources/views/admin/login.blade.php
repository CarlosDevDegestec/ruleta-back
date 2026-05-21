<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Login — Ruleta de Premios</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{background:#111;color:#e0e0e0;font-family:'Segoe UI',system-ui,sans-serif;display:flex;align-items:center;justify-content:center;min-height:100vh}
.login-card{background:#1a1a1a;border:1px solid #2a2a2a;border-radius:12px;padding:40px;width:100%;max-width:380px}
h1{font-size:1.4rem;font-weight:700;color:#FFB71B;text-align:center;margin-bottom:8px}
p{text-align:center;color:#888;font-size:.875rem;margin-bottom:28px}
label{display:block;font-size:.875rem;font-weight:500;margin-bottom:7px}
input{width:100%;background:#111;border:1px solid #2a2a2a;border-radius:7px;color:#e0e0e0;padding:11px 13px;font-size:.9rem;outline:none;margin-bottom:16px;transition:border-color .15s}
input:focus{border-color:#FFB71B}
.btn{width:100%;background:#FFB71B;color:#111;border:none;border-radius:7px;padding:12px;font-size:.95rem;font-weight:600;cursor:pointer;transition:background .15s}
.btn:hover{background:#e6a318}
.error{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#ef4444;padding:10px 14px;border-radius:7px;font-size:.85rem;margin-bottom:16px}
</style>
</head>
<body>
<div class="login-card">
  <h1>🎡 Ruleta Admin</h1>
  <p>Accede al panel de control</p>
  @if($errors->any())
  <div class="error">{{ $errors->first('credentials') ?? $errors->first() }}</div>
  @endif
  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <label>Usuario</label>
    <input type="text" name="username" value="{{ old('username') }}" required autofocus>
    <label>Contraseña</label>
    <input type="password" name="password" required>
    <button type="submit" class="btn">Iniciar Sesión</button>
  </form>
</div>
</body>
</html>