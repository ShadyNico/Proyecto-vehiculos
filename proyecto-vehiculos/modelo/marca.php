<?php
require_once 'database.php';

class Marca {
    public static function getMarcas() {
        $db = Database::marca_connection();
        $stmt = $db->query("SELECT id_marca, nombre, descripcion FROM marca ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }

    public static function create($nombre, $descripcion) {
        $db = Database::marca_connection();
        $stmt = $db->prepare("INSERT INTO marca (nombre, descripcion) VALUES (:n, :d)");
        $stmt->bindValue(":n", trim($nombre));
        $stmt->bindValue(":d", trim($descripcion));
        $stmt->execute();
        return true;
    }
}
