<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bienvenido · Imagina Colombia</title>

  <style>
    /* --- Reset box sizing para evitar desbordes inesperados --- */
    *, *::before, *::after { box-sizing: border-box; }

    :root {
      --bg-dark-1: #0b1220;
      --bg-dark-2: #0f1724;
      --card-bg: rgba(18, 22, 28, 0.72); /* translúcido oscuro */
      --card-border: rgba(255,255,255,0.04);
      --muted: #9aa4b2;
      --muted-2: #c7d2da;
      --accent: #06b6d4;
      --red-1: #ef4444;
      --red-2: #b91c1c;
      --success: #10b981;
      --text-light: #e6eef6;
    }

    html, body { height: 100%; }

    body {
      margin: 0;
      min-height: 100vh; /* evita scroll causado por 100% con padding */
      padding: 28px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: linear-gradient(180deg, var(--bg-dark-1) 0%, var(--bg-dark-2) 100%);
      color: var(--text-light);
      display: flex;
      align-items: center;
      justify-content: center;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      /* permitir scroll solo cuando haga falta, pero normalmente no lo habrá */
      overflow-y: auto;
    }

    /* Card principal */
    .card {
      background: var(--card-bg);
      backdrop-filter: blur(8px) saturate(120%);
      border: 1px solid var(--card-border);
      box-shadow: 0 12px 40px rgba(2,6,23,0.6);
      border-radius: 16px;
      max-width: 920px;
      width: 100%;
      padding: 36px;
      display: flex;
      gap: 28px;
      align-items: center;
      flex-wrap: wrap;
      transition: transform 0.22s ease;
    }

    /* Hover sutil sin romper layout */
    .card:hover { transform: translateY(-4px); }

    .brand { display: flex; align-items: center; gap: 18px; width: 100%; }

    .logo-wrap {
      width: 96px;
      height: 96px;
      flex: 0 0 96px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 14px;
      background: linear-gradient(145deg, var(--red-1) 0%, var(--red-2) 100%);
      box-shadow: 0 6px 20px rgba(185,28,28,0.18);
      color: #fff;
      font-weight: 700;
      font-size: 20px;
      letter-spacing: 0.6px;
    }

    .title { font-size: 22px; font-weight: 700; margin: 0; color: var(--text-light); }
    .subtitle { margin: 6px 0 0; color: var(--muted); line-height: 1.45; }

    .right-col { flex: 1; min-width: 220px; display: flex; flex-direction: column; gap: 10px; }

    .actions { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 6px; }

    a.cta {
      display: inline-block;
      padding: 10px 14px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.18s ease, transform 0.18s ease, color 0.18s ease;
    }

    a.cta:hover { transform: translateY(-2px); }

    a.primary {
      background: var(--accent);
      color: black;
    }

    a.primary:hover { background: #0891b2; color: #021017; }

    a.ghost {
      background: transparent;
      border: 1px solid rgba(255,255,255,0.06);
      color: var(--muted-2);
    }

    a.ghost:hover {
      border-color: rgba(255,255,255,0.12);
      color: var(--text-light);
    }

    .help { color: var(--muted); margin-top: 6px; }

    /* Status */
    .status {
      display: inline-flex;
      gap: 12px;
      align-items: center;
      margin-top: 8px;
      padding: 10px 12px;
      border-radius: 10px;
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(255,255,255,0.03);
      width: fit-content;
      font-size: 14px;
      color: var(--muted-2);
    }

    .status .dot {
      width: 10px; height: 10px; border-radius: 999px;
      background: var(--success);
      box-shadow: 0 0 0 6px rgba(16,185,129,0.06);
      flex-shrink: 0;
    }

    .status .label { font-weight: 600; color: var(--text-light); margin-right: 6px; }
    .status .ver { font-family: monospace; background: rgba(255,255,255,0.02); padding: 2px 6px; border-radius: 6px; font-weight:600; color: var(--muted-2); margin-left: 6px; }

    /* Responsive: reduce padding on small screens para evitar overflow */
    @media (max-width: 640px) {
      body { padding: 14px; }
      .card { padding: 20px; gap: 16px; }
      .brand { flex-direction: column; align-items: flex-start; gap: 12px; }
      .actions { width: 100%; }
      .help { text-align: center; width: 100%; }
      .status { width: 100%; justify-content: space-between; }
    }
  </style>
</head>
<body>
<main class="card" role="main" aria-labelledby="title">
  <div class="brand" style="align-items:flex-start;">
    <div class="logo-wrap" aria-hidden="true">IM</div>

    <div class="right-col">
      <div>
        <h1 id="title" class="title">API | Imagina Colombia</h1>
        <p class="subtitle">
          API de tu proyecto.<br />
          Administra el contenido desde el CMS o visita nuestro sitio principal.
        </p>
      </div>

      <div class="actions" aria-hidden="false">
        <a class="cta primary" href="/iadmin" title="Ir al CMS (panel de administración)">Abrir CMS</a>
        <a class="cta ghost" href="https://www.imaginacolombia.com" title="Visitar el sitio de Imagina Colombia" target="_blank" rel="noopener noreferrer">Ver más Productos</a>
      </div>

      <div class="status" role="status" aria-live="polite" aria-atomic="true">
        <span class="dot" aria-hidden="true"></span>
        <span><span class="label">API:</span> Activa <span class="ver">v12</span></span>
      </div>

      <p class="help">
        Si necesitas documentación de la API, contacta al equipo técnico:
        <a href="mailto:soporte@imaginacolombia.com">soporte@imaginacolombia.com</a>
      </p>
    </div>
  </div>
</main>
</body>
</html>
