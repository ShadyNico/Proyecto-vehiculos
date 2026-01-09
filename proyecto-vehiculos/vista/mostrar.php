<?php
include("./header.php");
include("../controlador/show.php");

$ok = isset($_GET["ok"]);
$updated = isset($_GET["updated"]);
$deleted = isset($_GET["deleted"]);
$error = $_GET["error"] ?? "";
?>

<div class="app-card p-4">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
      <h2 class="app-title m-0">Listado de Vehículos</h2>
      <p class="app-subtitle">Gestión de placa y modelo.</p>
    </div>
    <a href="./insertar.php" class="btn btn-primary">Nuevo</a>
  </div>

  <?php if ($ok) { ?><div class="alert alert-success mt-3">Registrado</div><?php } ?>
  <?php if ($updated) { ?><div class="alert alert-info mt-3">Actualizado</div><?php } ?>
  <?php if ($deleted) { ?><div class="alert alert-warning mt-3">Eliminado</div><?php } ?>
  <?php if (!empty($error)) { ?><div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div><?php } ?>

  <div class="table-responsive mt-3">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Placa</th>
          <th>Modelo</th>
          <th style="width:190px;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($vehiculos)) { ?>
          <?php foreach ($vehiculos as $v) { ?>
            <tr>
              <td class="fw-bold"><?php echo $v["id_vehiculo"]; ?></td>
              <td><?php echo htmlspecialchars($v["placa"]); ?></td>
              <td><?php echo htmlspecialchars($v["modelo"]); ?></td>
              <td class="d-flex gap-2">
                <a class="btn btn-outline-light btn-sm" href="./editar.php?id=<?php echo $v["id_vehiculo"]; ?>">Editar</a>
                <a class="btn btn-outline-danger btn-sm"
                   href="../controlador/delete.php?id=<?php echo $v["id_vehiculo"]; ?>"
                   onclick="return confirm('¿Eliminar este vehículo?');">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr><td colspan="4" class="text-center py-4">No hay registros</td></tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include("./footer.php"); ?>
