<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vehículos</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root{
      --bg:#0b0620;
      --border:rgba(168,85,247,.28);
      --text:#efeaff;
      --muted:rgba(239,234,255,.72);
      --primary:#7c3aed;
      --primary2:#a855f7;
    }

    body{
      color:var(--text);
      background:
        radial-gradient(1200px 650px at 15% 0%, rgba(124,58,237,.32), transparent 55%),
        radial-gradient(900px 520px at 90% 10%, rgba(168,85,247,.20), transparent 55%),
        radial-gradient(900px 520px at 50% 110%, rgba(124,58,237,.20), transparent 55%),
        var(--bg);
      min-height: 100vh;
    }

    .navbar-purple{
      background: linear-gradient(135deg, #1a0f3c, #0b0620);
      border-bottom: 1px solid var(--border);
      backdrop-filter: blur(8px);
    }
    .navbar-purple .navbar-brand,
    .navbar-purple .nav-link{
      color:var(--text) !important;
    }
    .navbar-purple .nav-link{ opacity:.88; }
    .navbar-purple .nav-link:hover{ opacity:1; }
    .navbar-purple .nav-link.active{
      opacity:1;
      font-weight:800;
      border-bottom: 2px solid rgba(168,85,247,.7);
      padding-bottom: .35rem;
    }

    .app-card{
      background: linear-gradient(180deg, rgba(18,11,43,.92), rgba(11,6,32,.92));
      border: 1px solid var(--border);
      border-radius: 18px;
      box-shadow: 0 18px 45px rgba(0,0,0,.35);
    }
    .app-title{ font-weight:900; margin:0; }
    .app-subtitle{ color: var(--muted); margin:.35rem 0 0 0; }
    .muted{ color: var(--muted); }

    .form-control, .form-select{
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(239,234,255,.18);
      color: var(--text);
      color-scheme: dark;
    }
    .form-control::placeholder{ color: rgba(239,234,255,.55); }
    .form-control:focus, .form-select:focus{
      background: rgba(255,255,255,.08);
      color: var(--text);
      border-color: rgba(168,85,247,.7);
      box-shadow: 0 0 0 .2rem rgba(124,58,237,.25);
    }

    /* FIX: dropdown options */
    .form-select option{
      background: #120b2b !important;
      color: #efeaff !important;
    }

    .btn-primary{
      background: linear-gradient(135deg, var(--primary), var(--primary2));
      border: 0;
    }
    .btn-outline-light{
      border-color: rgba(239,234,255,.35);
      color: var(--text);
    }
    .btn-outline-light:hover{
      background: rgba(239,234,255,.12);
      border-color: rgba(239,234,255,.55);
      color: var(--text);
    }

    .table{ color: var(--text); margin-bottom: 0; }
    .table thead th{
      background: rgba(124,58,237,.22);
      color: var(--text);
      border-bottom: 1px solid var(--border);
      white-space: nowrap;
    }
    .table td, .table th{
      border-color: rgba(239,234,255,.12);
      white-space: nowrap;
      vertical-align: middle;
    }
    .table tbody tr:hover{ background: rgba(239,234,255,.06); }
  </style>
</head>
<body>

<?php $page = basename($_SERVER["PHP_SELF"]); ?>

<nav class="navbar navbar-expand-lg navbar-purple">
  <div class="container">
    <a class="navbar-brand fw-bold" href="./index.php">
      <i class="bi bi-car-front-fill"></i> Vehículos
    </a>

    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-1">
        <li class="nav-item">
          <a class="nav-link <?php echo $page==='index.php'?'active':''; ?>" href="./index.php">
            <i class="bi bi-house"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page==='insertar.php'?'active':''; ?>" href="./insertar.php">
            <i class="bi bi-plus-circle"></i> Insertar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $page==='mostrar.php'?'active':''; ?>" href="./mostrar.php">
            <i class="bi bi-card-list"></i> Mostrar
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container py-4">
