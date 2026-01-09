<?php
require_once 'database.php';

class Color {
    public static function getColores() {
        $db = Database::color_connection();
        $stmt = $db->query("SELECT id_color, nombre, descripcion FROM color ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }

    public static function create($nombre, $descripcion) {
        $db = Database::color_connection();
        $stmt = $db->prepare("INSERT INTO color (nombre, descripcion) VALUES (:n, :d)");
        $stmt->bindValue(":n", trim($nombre));
        $stmt->bindValue(":d", trim($descripcion));
        $stmt->execute();
        return true;
    }
}
