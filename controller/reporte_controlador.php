<?php

class ControladorReportes
{

    public function getReporte($body)
    {


        $reporte = ModeloReporte::reporte($body);
        echo json_encode($reporte);
        return;


        // $fi = explode('/', $body['fecha_ini']);
        // $ff = explode('/', $body['fecha_fin']);

        // if (count($fi) == 3 && count($ff) == 3) {
        //     if (checkdate($fi[1], $fi[0], $fi[2]) && checkdate($ff[1], $ff[0], $ff[2])) {

        //         $reporte = ModeloReporte::reporte($body);

        //         echo json_encode($reporte);
        //         return;
        //     } else {
        //         echo json_encode('error de fecha, formato no valido !!');
        //         return;
        //     }
        // } else {
        //     echo json_encode('error de fecha !!');
        //     return;
        // }


    }


}



?>