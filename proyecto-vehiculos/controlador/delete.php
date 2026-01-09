<?php
require_once("../modelo/vehiculo.php");

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: ../vista/mostrar.php?error=" . urlencode("ID inválido"));
    exit;
}

try {
    Vehiculo::delete($id);
    header("Location: ../vista/mostrar.php?deleted=1");
    exit;
} catch (Exception $e) {
    header("Location: ../vista/mostrar.php?error=" . urlencode("Error al eliminar"));
    exit;
}
