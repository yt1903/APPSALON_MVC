<?php
namespace Controllers;

use MVC\Router;
use Model\AdminCita;


class AdminController{
    public static function index(Router $router){
        session_start();

        isAdmin();//verifica que el admin este logueado

        $fecha =$_GET['fecha'] ??  date('Y-m-d');//si hay un get toma la fecha del get de lo contrario la del servidor
        $fechaExplode=explode('-',$fecha);
        if (!checkdate($fechaExplode[1],$fechaExplode[2],$fechaExplode[0])){
                header('Location: /404'); //Si es una fecha invalida pagina no encontrada
        }
    
       
   
        //Consultar la base de datos___ como esta consulta usa mas de una tabla
        //no se puede usar el ActiveRecord, se va a ejecutar el query y luego se invocan 
        // las funciones de Active record para que le de el formato que necesitamos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas= AdminCita::SQL($consulta);

     


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
             'citas' => $citas,
             'fecha' =>$fecha
        ]);

    }// index
}//AdminController