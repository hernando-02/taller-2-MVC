<?php
class ControladorAlquileres
{
    // * CREATE RENTAL
    public function create($data)
    {

        if (isset($data['id_auto']) && !is_numeric($data['id_auto'])) {

            $json = array(
                "detalle" => " error, el id del carro es solo numeros"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;

            // !! esto lo puedo refactorizar 
        } else if (isset($data['nombre_cliente']) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $data['nombre_cliente'])) {

            $json = array(
                "detalle" => " error, el nombre cliente es solo letras"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;

        }

        // validar nombre prestador
        else if (isset($data['nombre_prestador']) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/', $data['nombre_prestador'])) {

            $json = array(
                "detalle" => " error, el nombre del prestador es solo letras"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;

        }


        // validar correo
        else if (isset($data['km_recorridos']) && !is_numeric($data['km_recorridos'])) {

            $json = array(
                "detalle" => " error, el km del carro es solo numeros"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;

            // !! esto lo puedo refactorizar 
        } else if (isset($data['precio']) && !is_numeric($data['precio'])) {

            $json = array(
                "detalle" => " error, el precio es solo numeros"
            );
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($json, true);
            return;

            // !! esto lo puedo refactorizar 
        } else {
            $alquileresCreate = ModeloAlquileres::create("alquileres", $data);
            if ($alquileresCreate == 'ok') {

                header('Content-type:application/json;charset=utf-8');
                echo json_encode($data, true);
                return;
            }
        }



    }

    public function getAll()
    {
        $alquileresGetAll = ModeloAlquileres::getAll('alquileres');
        echo json_encode($alquileresGetAll);
        return;
    }

    public function getById($id)
    {
        $alquileresGet = ModeloAlquileres::getById('alquileres', $id);
        $autoGet = ModeloCarros::getCarById('carros', $alquileresGet['id_auto']);

        $res = array(
            'id_alquiler' => $alquileresGet['id'],
            'id_auto' => $alquileresGet['id_auto'],
            'nombre_cliente' => $alquileresGet['nombre_cliente'],
            'email_cliente' => $alquileresGet['email_cliente'],
            'nombre_prestador' => $alquileresGet['nombre_prestador'],
            'hora_inicio' => $alquileresGet['hora_inicio'],
            'fecha_devolucion' => $alquileresGet['fecha_devolucion'],
            'km_recorridos' => $alquileresGet['km_recorridos'],
            'precio' => $alquileresGet['precio'],
            'auto_alquilado' => $autoGet
        );

        echo json_encode($res, true);
        return;
    }

    public function deleteById($id)
    {
        $alquilerDelete = ModeloAlquileres::deleteAlquiler("alquileres", $id);
        $autoGet = ModeloCarros::getCarById('carros', $alquilerDelete['id_auto']);
        echo json_encode([
            'mensaje' => 'Registro eliminado satisfactoriamente',
            'data' => [
                'id_alquiler' => $alquilerDelete['id'],
                'id_auto' => $alquilerDelete['id_auto'],
                'nombre_cliente' => $alquilerDelete['nombre_cliente'],
                'email_cliente' => $alquilerDelete['email_cliente'],
                'nombre_prestador' => $alquilerDelete['nombre_prestador'],
                'hora_inicio' => $alquilerDelete['hora_inicio'],
                'fecha_devolucion' => $alquilerDelete['fecha_devolucion'],
                'km_recorridos' => $alquilerDelete['km_recorridos'],
                'precio' => $alquilerDelete['precio'],
                'auto_alquilado' => $autoGet
            ]

        ]);
        return;


    }

    public function updateById($data, $id)
    {
        $alquilerUpdate = ModeloAlquileres::updateAlquiler("alquileres", $data, $id);
        $autoGet = ModeloCarros::getCarById('carros', $alquilerUpdate['id_auto']);

        echo json_encode([
            'mensaje' => 'Registro actualizado satisfactoriamente',
            'data' => [
                'id_alquiler' => $alquilerUpdate['id'],
                'id_auto' => $alquilerUpdate['id_auto'],
                'nombre_cliente' => $alquilerUpdate['nombre_cliente'],
                'email_cliente' => $alquilerUpdate['email_cliente'],
                'nombre_prestador' => $alquilerUpdate['nombre_prestador'],
                'hora_inicio' => $alquilerUpdate['hora_inicio'],
                'fecha_devolucion' => $alquilerUpdate['fecha_devolucion'],
                'km_recorridos' => $alquilerUpdate['km_recorridos'],
                'precio' => $alquilerUpdate['precio'],
                'auto_alquilado' => $autoGet
            ]
        ]);
        return;


    }
}