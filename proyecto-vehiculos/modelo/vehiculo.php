<?php
require_once 'database.php';

class Vehiculo {

    public static function getVehiculos() {
        $db = Database::vehiculo_connection();
        $stmt = $db->query("SELECT id_vehiculo, placa, modelo FROM vehiculo ORDER BY id_vehiculo DESC");
        return $stmt->fetchAll();
    }

    public static function getVehiculoById($id) {
        $db = Database::vehiculo_connection();
        $stmt = $db->prepare("SELECT id_vehiculo, placa, modelo FROM vehiculo WHERE id_vehiculo = :id");
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function create($placa, $modelo) {
        $db = Database::vehiculo_connection();
        $stmt = $db->prepare("INSERT INTO vehiculo (placa, modelo) VALUES (:p, :m)");
        $stmt->bindValue(":p", $placa);
        $stmt->bindValue(":m", $modelo);
        $stmt->execute();
        return true;
    }

    public static function update($id, $placa, $modelo) {
        $db = Database::vehiculo_connection();
        $stmt = $db->prepare("UPDATE vehiculo SET placa=:p, modelo=:m WHERE id_vehiculo=:id");
        $stmt->bindValue(":p", $placa);
        $stmt->bindValue(":m", $modelo);
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public static function delete($id) {
        $db = Database::vehiculo_connection();
        $stmt = $db->prepare("DELETE FROM vehiculo WHERE id_vehiculo=:id");
        $stmt->bindValue(":id", (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
}
