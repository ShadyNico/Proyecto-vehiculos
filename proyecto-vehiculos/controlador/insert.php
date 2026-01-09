<?php
require_once("../modelo/vehiculo.php");

function clean_upper($v){ return strtoupper(trim((string)$v)); }

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../vista/insertar.php");
    exit;
}

$placa = clean_upper($_POST["placa"] ?? "");
$modelo = trim($_POST["modelo"] ?? "");

if (!preg_match('/^[A-Z]{3}[0-9]{4}$/', $placa)) {
    header("Location: ../vista/insertar.php?error=" . urlencode("Placa inválida. Formato: ABC2313"));
    exit;
}

if (strlen($modelo) < 2 || strlen($modelo) > 50) {
    header("Location: ../vista/insertar.php?error=" . urlencode("Modelo inválido (2-50 caracteres)"));
    exit;
}

try {
    Vehiculo::create($placa, $modelo);
    header("Location: ../vista/mostrar.php?ok=1");
    exit;
} catch (Exception $e) {
    header("Location: ../vista/insertar.php?error=" . urlencode("Error al guardar"));
    exit;
}
