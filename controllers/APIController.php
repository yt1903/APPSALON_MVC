<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;


class APIController{
    //No Requieren Router porque estas funciones se invocan desde el archivo app.js, como api
    //No requiere render
    public static function index(){
        $servicios= Servicio::all(); //:: es un metodo estatico y no requiere instanciar

       echo json_encode($servicios); //convierte el arreglo asociativo en un json
    }//index

    public static function guardar(){
        //Guarda la Cita y devuelve el Id nuevo 
    
        $cita = new Cita ($_POST);
        $resultado = $cita -> guardar();

        $id=$resultado['id'];
   
        //Guarda los servicios citasservicios
        //$_POST['servicios'] es un string separado por coma, lo que se 
        //va  a hacer en separarlo en un arreglo.
        $idServicios= explode(',', $_POST['servicios']);
       
      
        foreach($idServicios as $idServicio){
            $args= [
                'citaId' => $id,
                'servicioId'=> $idServicio
            ];
                     
        
            $citaServicio= new CitaServicio($args);
            $citaServicio->guardar();
        }
        

   
      
    
    

        //respuesta es un arreglo asociativo que json_encode se puede convertir en Json que lo puedo leer en Js
        //una arreglo asociativo es equivalente a un objeto en Js
        echo  json_encode( ['resultado' => $resultado]);

       
        // Postman sirve para múltiples tareas dentro de las cuales destacaremos en esta oportunidad las siguientes:
        // Testear colecciones o catálogos de APIs tanto para Frontend como para Backend.
        // Organizar en carpetas, funcionalidades y módulos los servicios web.
        // Permite gestionar el ciclo de vida (conceptualización y definición, desarrollo, monitoreo y mantenimiento) de nuestra API.
        // Generar documentación de nuestras APIs.
        // Trabajar con entornos (calidad, desarrollo, producción) y de este modo es posible compartir a través de un entorno cloud la información con el resto del equipo involucrado en el desarrollo.
        //   
    }//guardar
    public static function eliminar(){

        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $id=$_POST['id'];
            $cita= Cita::find($id);//por comfiguracion de la bd se van a eliminar tablas hijas
            $cita->eliminar();
            header('Location: ' . $_SERVER['HTTP_REFERER']);//VUELVE A LA MISMA PAGINA DONDE ESTA

        }

    }//eliminar


}