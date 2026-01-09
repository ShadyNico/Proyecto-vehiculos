<?php
require_once("../modelo/marca.php");
require_once("../modelo/color.php");

$marcas = Marca::getMarcas();
$MARCAS = array_map(fn($marca) => $marca["nombre"], $marcas);

$colores = Color::getColores();
$COLORES = array_map(fn($color) => $color["nombre"], $colores);
