<?php
require_once("../modelo/color.php");
require_once("../modelo/marca.php");
require_once("../modelo/database.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../vista/index.php");
    exit;
}

$tipo   = trim($_POST["tipo"] ?? "");
$nombre = trim($_POST["nombre"] ?? "");

$esColor = ($tipo === "color");
$esMarca = ($tipo === "marca");
if ((!$esColor && !$esMarca) || $nombre === "") {
    header("Location: ../vista/index.php?cat_error=Datos invalidos");
    exit;
}

try {
    if ($esColor) {
        Color::create($nombre, "");
    } else {
        Marca::create($nombre, "");
    }

    $conn = Database::vehiculo_connection();
    $log = $conn->prepare("INSERT INTO actividad_log (accion, vehiculo_id) VALUES ('INSERT', NULL)");
    $log->execute();

    header("Location: ../vista/index.php?cat_ok=1");
    exit;

} catch (PDOException $e) {
    if (strpos($e->getMessage(), "1062") !== false) {
        header("Location: ../vista/index.php?cat_error=Ya existe");
        exit;
    }
    header("Location: ../vista/index.php?cat_error=Error al guardar");
    exit;
}
