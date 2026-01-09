<?php
include("./header.php");
require_once("../modelo/vehiculo.php");

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) { header("Location: ./mostrar.php"); exit; }

$vehiculo = Vehiculo::getVehiculoById($id);
if (!$vehiculo) { header("Location: ./mostrar.php"); exit; }

$error = $_GET["error"] ?? "";
?>

<div class="app-card p-4">
  <h2 class="app-title">Editar Vehículo</h2>

  <?php if (!empty($error)) { ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php } ?>

  <form action="../controlador/update.php" method="POST" class="row g-3">
    <input type="hidden" name="id_vehiculo" value="<?php echo $vehiculo["id_vehiculo"]; ?>">

    <div class="col-md-6">
      <label class="form-label">Placa</label>
      <input
        name="placa"
        class="form-control"
        maxlength="7"
        pattern="[A-Z]{3}[0-9]{4}"
        title="Formato válido: ABC2313"
        required
        value="<?php echo htmlspecialchars($vehiculo["placa"]); ?>"
      >
    </div>

    <div class="col-md-6">
      <label class="form-label">Modelo</label>
      <input name="modelo" class="form-control" maxlength="50" required
             value="<?php echo htmlspecialchars($vehiculo["modelo"]); ?>">
    </div>

    <div class="col-12 d-flex justify-content-between">
      <a href="./mostrar.php" class="btn btn-outline-light">Volver</a>
      <button class="btn btn-primary">Guardar cambios</button>
    </div>
  </form>
</div>

<?php include("./footer.php"); ?>
