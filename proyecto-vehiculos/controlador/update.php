<?php
require_once("../modelo/vehiculo.php");

function clean_upper($v){ return strtoupper(trim((string)$v)); }

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../vista/mostrar.php");
    exit;
}

$id = (int)($_POST["id_vehiculo"] ?? 0);
$placa = clean_upper($_POST["placa"] ?? "");
$modelo = trim($_POST["modelo"] ?? "");

if ($id <= 0) {
    header("Location: ../vista/mostrar.php?error=" . urlencode("ID inválido"));
    exit;
}

if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $placa)) {
    header("Location: ../vista/editar.php?id=$id&error=" . urlencode("Placa inválida. Formato: ABC2313"));
    exit;
}

if (strlen($modelo) < 2 || strlen($modelo) > 50) {
    header("Location: ../vista/editar.php?id=$id&error=" . urlencode("Modelo inválido (2-50 caracteres)"));
    exit;
}

try {
    Vehiculo::update($id, $placa, $modelo);
    header("Location: ../vista/mostrar.php?updated=1");
    exit;
} catch (Exception $e) {
    header("Location: ../vista/editar.php?id=$id&error=" . urlencode("Error al actualizar"));
    exit;
}
