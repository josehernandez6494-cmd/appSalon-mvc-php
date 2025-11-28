<?php
namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class APIController {
    public static function index() {
        header('Content-Type: application/json; charset=utf-8');
        // Si tu ActiveRecord devuelve objetos, asegúrate de serializarlos a array
        $servicios = Servicio::all(); // Debe devolver array de objetos/arrays
        //debuguear($servicios);
        echo json_encode($servicios, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }

    public static function guardar() {
        
        // Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];
        //debuguear($resultado);

        // Almacena la Cita y el Servicio
        // Almacena los Servicios con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        // Responder con un mensaje de éxito
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['resultado' => $resultado], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        exit;
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            // Eliminar la cita
            $cita = Cita::find($id);
            //echo json_encode($cita);
            if($cita) {
                $cita->eliminar();
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['resultado' => 'ok']);
                header('Location:' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['resultado' => 'error', 'mensaje' => 'Cita no encontrada']);
            }
        }
    }   
}