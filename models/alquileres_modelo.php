<?php

require_once "conexion.php";

class ModeloAlquileres
{
    static public function create($tabla, $body)
    {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO alquileres(id_auto, nombre_cliente, email_cliente, nombre_prestador, hora_inicio, fecha_devolucion, km_recorridos,precio)
             VALUES (:id_auto, :nombre_cliente, :email_cliente,:nombre_prestador, :hora_inicio, :fecha_devolucion, :km_recorridos, :precio)"
        );

        $stmt->bindParam(':id_auto', $body['id_auto']);
        $stmt->bindParam(':nombre_cliente', $body['nombre_cliente']);
        $stmt->bindParam(':email_cliente', $body['email_cliente']);
        $stmt->bindParam(':nombre_prestador', $body['nombre_prestador']);
        $stmt->bindParam(':hora_inicio', $body['hora_inicio']);
        $stmt->bindParam(':fecha_devolucion', $body['fecha_devolucion']);
        $stmt->bindParam(':km_recorridos', $body['km_recorridos']);
        $stmt->bindParam(':precio', $body['precio']);
        header('Content-type:application/json;charset=utf-8');

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;

    }


    static public function getAll($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * from $tabla a INNER JOIN carros c on c.id = a.id ORDER BY(a.id)");
        $stmt->execute();
        header('Content-type:application/json;charset=utf-8');

        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;

        $stmt->close();
        $stmt = null;

    }

    static public function getById($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();

        header('Content-type:application/json;charset=utf-8');

        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        return $result;

        $stmt->close();
        $stmt = null;

    }

    static public function deleteAlquiler($tabla, $id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $statement = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $statement->bindParam(':id', $id);

        $statement->execute();

        header('Content-type:application/json;charset=utf-8');
        if ($statement->execute()) {
            return $res;
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;

    }

    static public function updateAlquiler($tabla, $body, $id)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE alquileres 
            SET id = :id_alquiler, id_auto = :id_auto, nombre_cliente = :nombre_cliente, email_cliente = :email_cliente, nombre_prestador = :nombre_prestador, hora_inicio = :hora_inicio, fecha_devolucion = :fecha_devolucion, km_recorridos = :km_recorridos ,precio = :precio
            WHERE id = :id_alquiler"
        );

        $stmt->bindParam(':id_alquiler', $id);
        $stmt->bindParam(':id_auto', $body['id_auto']);
        $stmt->bindParam(':nombre_cliente', $body['nombre_cliente']);
        $stmt->bindParam(':email_cliente', $body['email_cliente']);
        $stmt->bindParam(':nombre_prestador', $body['nombre_prestador']);
        $stmt->bindParam(':hora_inicio', $body['hora_inicio']);
        $stmt->bindParam(':fecha_devolucion', $body['fecha_devolucion']);
        $stmt->bindParam(':km_recorridos', $body['km_recorridos']);
        $stmt->bindParam(':precio', $body['precio']);
        // $stmt->execute();

        header('Content-type:application/json;charset=utf-8');

        if ($stmt->execute()) {
            return ModeloAlquileres::getById('alquileres', $id);
        } else {
            return print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->close();
        $stmt = null;

    }





}

?>