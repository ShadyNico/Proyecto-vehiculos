<?php
include("./header.php");
require_once("../modelo/database.php");

$conn = Database::vehiculo_connection();
$conn->exec("SET NAMES utf8mb4");

$cat_ok = isset($_GET["cat_ok"]);
$cat_error = $_GET["cat_error"] ?? "";

// ---- Construir días (últimos 14 días) ----
$dias = [];
for ($i = 13; $i >= 0; $i--) {
  $dias[] = date("Y-m-d", strtotime("-$i day"));
}

// ---- Inicializar arrays ----
$insert = array_fill(0, count($dias), 0);
$update = array_fill(0, count($dias), 0);
$delete = array_fill(0, count($dias), 0);

$idx = array_flip($dias);

// ---- Traer actividad agrupada por día y acción ----
$stmt = $conn->prepare("
  SELECT DATE(created_at) AS dia, accion, COUNT(*) AS total
  FROM actividad_log
  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 13 DAY)
  GROUP BY DATE(created_at), accion
  ORDER BY dia ASC
");
$stmt->execute();
$rows = $stmt->fetchAll();

foreach ($rows as $r) {
  $d = $r["dia"];
  if (!isset($idx[$d])) continue;

  $pos = $idx[$d];
  $accion = $r["accion"];
  $total = (int)$r["total"];

  if ($accion === "INSERT") $insert[$pos] = $total;
  if ($accion === "UPDATE") $update[$pos] = $total;
  if ($accion === "DELETE") $delete[$pos] = $total;
}
?>

<div class="app-card p-4">
  <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
      <h1 class="app-title">Dashboard CRUD Vehículos</h1>
      <p class="app-subtitle">Actividad por día + gestión de catálogos (marcas y colores).</p>
    </div>

    <div class="d-flex gap-2">
      <a href="./insertar.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Insertar</a>
      <a href="./mostrar.php" class="btn btn-outline-light"><i class="bi bi-card-list"></i> Mostrar</a>
    </div>
  </div>

  <hr style="border-color: rgba(239,234,255,.18);">

  <?php if ($cat_ok) { ?>
    <div class="alert alert-success"><i class="bi bi-check-circle"></i> Guardado correctamente.</div>
  <?php } ?>
  <?php if (!empty($cat_error)) { ?>
    <div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($cat_error); ?></div>
  <?php } ?>

  <div class="row g-4">
    <div class="col-lg-7">
      <div class="app-card p-3">
        <div class="fw-bold mb-1"><i class="bi bi-activity"></i> Actividad (últimos 14 días)</div>
        <div class="muted mb-3">Inserciones, ediciones y eliminaciones registradas en la base.</div>
        <canvas id="activityChart" height="120"></canvas>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="app-card p-3">
        <div class="fw-bold mb-1"><i class="bi bi-sliders"></i> Agregar Marca / Color</div>
        <div class="muted mb-3">Esto alimenta los dropdown del formulario.</div>

        <form action="../controlador/catalogo_insert.php" method="POST" class="row g-2">
          <div class="col-md-5">
            <select name="tipo" class="form-select" required>
              <option value="" selected disabled>Tipo</option>
              <option value="marca">Marca</option>
              <option value="color">Color</option>
            </select>
          </div>
          <div class="col-md-7">
            <input name="nombre" class="form-control" placeholder="Ej: Suzuki / Violeta" required maxlength="50">
          </div>
          <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
          </div>
        </form>

        <div class="muted mt-2" style="font-size:.9rem;">
          Si ya existe, no se duplica (UNIQUE).
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  const labels = <?php echo json_encode($dias); ?>;
  const dataInsert = <?php echo json_encode($insert); ?>;
  const dataUpdate = <?php echo json_encode($update); ?>;
  const dataDelete = <?php echo json_encode($delete); ?>;

  new Chart(document.getElementById('activityChart'), {
    type: 'line',
    data: {
      labels,
      datasets: [
        {
          label: 'Registros creados',
          data: dataInsert,
          borderWidth: 2,
          tension: 0.35,
          pointRadius: 3
        },
        {
          label: 'Registros editados',
          data: dataUpdate,
          borderWidth: 2,
          tension: 0.35,
          pointRadius: 3
        },
        {
          label: 'Registros eliminados',
          data: dataDelete,
          borderWidth: 2,
          tension: 0.35,
          pointRadius: 3
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: {
            color: '#efeaff',
            font: { size: 13 }
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.dataset.label + ': ' + context.parsed.y + ' acciones';
            }
          }
        }
      },
      scales: {
        x: {
          ticks: {
            color: '#efeaff',
            maxRotation: 45,
            minRotation: 45
          },
          grid: { color: 'rgba(239,234,255,.08)' }
        },
        y: {
          beginAtZero: true,
          ticks: {
            color: '#efeaff',
            precision: 0
          },
          grid: { color: 'rgba(239,234,255,.08)' }
        }
      }
    }
  });
</script>


<?php include("./footer.php"); ?>
