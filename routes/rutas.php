<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

// echo $_SERVER['REQUEST_URI'];   
// echo "<pre>"; print_r($arrayRutas); echo "<pre>";


if (count(array_filter($arrayRutas)) == 2) {
    $json = array(
        "detalle" => "no encontrado"

    );
    echo json_encode($json, true);
    return;

} else {

    if (count(array_filter($arrayRutas)) == 3) {

        if (array_filter($arrayRutas)[3] == 'carros') {

            $body = json_decode(file_get_contents("php://input"), true);

            // ******************* crear carro
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = array(
                    "marca" => $body['marca'],
                    "modelo" => $body['modelo'],
                    "placa" => $body['placa']
                );

                $carrosCreate = new ContrladorCarros();
                $carrosCreate->create($data);

            }

            // ? listar todos carros 
            else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $carrosAll = new ContrladorCarros();
                $carrosAll->getAll();
            }

        }

        if (array_filter($arrayRutas)[3] == 'alquileres') {

            $body = json_decode(file_get_contents("php://input"), true);

            // ***** guardar alquiler
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {


                $data = array(
                    'id_auto' => $body['id_auto'],
                    'nombre_cliente' => $body['nombre_cliente'],
                    'email_cliente' => $body['email_cliente'],
                    'nombre_prestador' => $body['nombre_prestador'],
                    'hora_inicio' => $body['hora_inicio'],
                    'fecha_devolucion' => $body['fecha_devolucion'],
                    'km_recorridos' => $body['km_recorridos'],
                    'precio' => $body['precio'],
                );

                $alquileres = new ControladorAlquileres();
                $alquileres->create($data);


            }

            // ***** listar alquileres
            else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $alquileres = new ControladorAlquileres();
                $alquileres->getAll();


            }

        }


        // ****** esto es para ver el reporte #################
        if (array_filter($arrayRutas)[3] == 'reportes') {

            // $_SERVER['REQUEST_URI'];
            // print_r($_GET['id']);

            $body = json_decode(file_get_contents("php://input"), true);
            // ** reportes
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {


                $data = array(
                    "fecha_ini" => $body['fecha_ini'],
                    "fecha_fin" => $body['fecha_fin']

                );
                // ****** esto es para ver el reporte
                $reporte = new ControladorReportes();
                $reporte->getReporte($data);
            }




        }

    } else {
        if (array_filter($arrayRutas)[3] == "carros" && is_numeric(array_filter($arrayRutas)[4])) {

            // ? obtener un carro por id
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $carrosById = new ContrladorCarros();
                $carrosById->getById(array_filter($arrayRutas)[4]);
            }


        }

        if (array_filter($arrayRutas)[3] == "updatecar" && is_numeric(array_filter($arrayRutas)[4])) {

            $body = json_decode(file_get_contents("php://input"), true);
            // ? actualizar un carro por id            
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = array(
                    "marca" => $body['marca'],
                    "modelo" => $body['modelo'],
                    "placa" => $body['placa']
                );

                $carrosUpdate = new ContrladorCarros();
                $carrosUpdate->updateById($data, array_filter($arrayRutas)[4]);


            }


        } else if (array_filter($arrayRutas)[3] == "deletecar" && is_numeric(array_filter($arrayRutas)[4])) {

            // $body = json_decode(file_get_contents("php://input"), true);
            // ? actualizar un carro por id            
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $carrosdelete = new ContrladorCarros();
                $carrosdelete->deleteById(array_filter($arrayRutas)[4]);


            }


        }

        if (array_filter($arrayRutas)[3] == "alquileres" && is_numeric(array_filter($arrayRutas)[4])) {

            // ? obtener un carro por id
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                $alquileres = new ControladorAlquileres();
                $alquileres->getById(array_filter($arrayRutas)[4]);
            }


        }
        if (array_filter($arrayRutas)[3] == "alquileres-delete" && is_numeric(array_filter($arrayRutas)[4])) {

            // ? obtener un carro por id
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
                $alquileres = new ControladorAlquileres();
                $alquileres->deleteById(array_filter($arrayRutas)[4]);
            }


        }
        if (array_filter($arrayRutas)[3] == "alquileres-update" && is_numeric(array_filter($arrayRutas)[4])) {

            $body = json_decode(file_get_contents("php://input"), true);
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

                $data = array(
                    'id_auto' => $body['id_auto'],
                    'nombre_cliente' => $body['nombre_cliente'],
                    'email_cliente' => $body['email_cliente'],
                    'nombre_prestador' => $body['nombre_prestador'],
                    'hora_inicio' => $body['hora_inicio'],
                    'fecha_devolucion' => $body['fecha_devolucion'],
                    'km_recorridos' => $body['km_recorridos'],
                    'precio' => $body['precio'],
                );

                $carrosUpdate = new ControladorAlquileres();
                $carrosUpdate->updateById($data, array_filter($arrayRutas)[4]);


            }


        }
    }

}