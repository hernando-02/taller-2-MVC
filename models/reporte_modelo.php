<?php

require_once "conexion.php";

class ModeloReporte
{
    static public function reporte($body)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM alquileres a JOIN carros c ON c.id = a.id_auto  WHERE hora_inicio  BETWEEN :fi AND :fe");
        $stmt->bindParam(':fi', $body['fecha_ini']);
        $stmt->bindParam(':fe', $body['fecha_fin']);

        $stmt->execute();
        header('Content-type:application/json;charset=utf-8');

        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;

        $stmt->close();
        $stmt = null;

    }
}


?>