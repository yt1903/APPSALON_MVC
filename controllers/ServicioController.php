<?php
namespace Controllers;

use MVC\Router;
use Model\Servicio;



class ServicioController{
    public static function index(Router $router){
        session_start();

        isAdmin();

        $servicios= Servicio::all();

        $router->render('servicios/index',[
            'nombre'    =>$_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }//index

    public static function crear(Router $router){
        session_start();
        isAdmin();

        $servicio= New Servicio;
        $alertas=[];

        

        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $servicio-> sincronizar($_POST);
            $alertas= $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location:/servicios');
            }
           

        }
        
        $router->render('servicios/crear',[
            'nombre' =>$_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }//crear


    public static function actualizar(Router $router){
        session_start();
        isAdmin();
        
        $alertas=[];
        if(!is_numeric($_GET['id'])) return;
        $id=$_GET['id'];
        
        $servicio= Servicio::find($id);

        

        if ($_SERVER['REQUEST_METHOD']==='POST'){
            $servicio->sincronizar($_POST);

            $alertas=$servicio->validar();

            
            if (empty($alertas)){

                $servicio->guardar();
    
                header('Location:\servicios');
            }
            

            
        }
        
        $router->render('servicios/actualizar',[
            'nombre' =>$_SESSION['nombre'],
            'alertas'=>$alertas,
            'servicio'=>$servicio
        ]);
    }//actualizar

    public static function eliminar(){
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD']==='POST'){
            
            $id=$_POST['id'];

            $servicio= Servicio::find($id);
            $servicio->eliminar();

            header('Location: /servicios');
        }
        

    }//actualizar
}//SevicioController