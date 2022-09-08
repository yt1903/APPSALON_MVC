<?php

namespace Controllers;

use MVC\Router;

class CitaController{
    public static function index(Router $router){

        session_start();

        isAuth();//verifica que la session este abierta 

        $router->render('cita/index',[
            'nombre'=>$_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);

    }//index
}//Controller class