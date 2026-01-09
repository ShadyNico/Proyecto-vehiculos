<?php
include("./header.php");
$error = $_GET["error"] ?? "";
?>

<div class="app-card p-4">
  <h2 class="app-title">Registrar Vehículo</h2>

  <?php if (!empty($error)) { ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php } ?>

  <form action="../controlador/insert.php" method="POST" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Placa</label>
      <input
        name="placa"
        class="form-control"
        placeholder="Ej: ABC2313"
        maxlength="7"
        pattern="[A-Z]{3}[0-9]{4}"
        title="Formato válido: ABC2313"
        required
      >
    </div>

    <div class="col-md-6">
      <label class="form-label">Modelo</label>
      <input name="modelo" class="form-control" maxlength="50" required>
    </div>

    <div class="col-12 d-flex justify-content-end">
      <button class="btn btn-primary">Guardar</button>
    </div>
  </form>
</div>

<?php include("./footer.php"); ?>
