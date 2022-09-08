<?php
namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;



class LoginController{

   public static function login(Router $router){
    $alertas=[];
    $auth= new Usuario($_POST);

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        //$auth= new Usuario($_POST);
        $auth -> sincronizar($_POST);
        $alertas=$auth->validarLogin();
       
        if (empty($alertas)){
            //Comprobar que exista el usuario
            $usuario=Usuario::where('email',$auth->email);
        
            if($usuario){
                //Verificar el Password
                if ($usuario->comprobarPasswordAndVerificado($auth->password)){
                    session_start();
                    $_SESSION['id']=$usuario->id;
                    $_SESSION['nombre']=$usuario->nombre . " " . $usuario->apellido;
                    $_SESSION['email']=$usuario->email;
                    $_SESSION['login']=true;

                    //Redireccionamiento
                    if ($usuario->admin === "1"){
                        //es admin
                        $_SESSION['admin']=$usuario->admin ?? null;
                        header('Location: /admin');
                    }else{
                        //usuario normal
                        header('Location: /cita');
                    }
                 
                }
               

            }else{
                Usuario::setAlerta('error','Usuario no Encontrado');

            }

        }
        
    }
    $alertas=Usuario::getAlertas();

    $router->render('auth/login',[
        'alertas' => $alertas,
        'auth' => $auth
    ]);
       
   }//login


   public static function logout(){
        session_start();
        $_SESSION=[];
        header('Location: /');
    }//logout


    public static function olvide(Router $router){

        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $auth=new Usuario($_POST);
            $alertas = $auth->validarEmail();


            if (empty($alertas)){
                $usuario= Usuario::where('email', $auth->email);
              
                if($usuario && $usuario->confirmado==="1"){
                    //Crear Token
                    $usuario->crearToken();
                    
                    //Guarda token usuario
                    $resultado= $usuario->guardar();
                    //Enviar email para confirmar el toke
                    $email= new Email($usuario->email,$usuario->nombre,$usuario->token);
    
                    $email->enviarInstrucciones();


    
                    //debuguear($usuario);

                    Usuario::setAlerta('exito','Revisa Tu Email');
                    
                }else{
                    Usuario::setAlerta('error', 'No se logró confirmación');
                }//else
                
            
            $alertas=   Usuario::getAlertas();

            }//empty

        }


        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);

    }//olvide

    public static function recuperar(Router $router){
        $alertas=[];
        $error=false;
        $token=s($_GET['token']);

        //BUSCAR USUARIO POR EL TOKEN
        $usuario= Usuario::where('token', $token);
        
        if (empty($usuario)){
            Usuario::setAlerta('error','Toke no válido');
            $error=true;
        }

       
        if ($_SERVER['REQUEST_METHOD'] ==='POST'){
            //leer el nuevo password y guardarlo
            $password= new Usuario($_POST);

            $alertas=$password->validaPassword();


            if(empty($alertas)){

                $usuario->password =null;
                $usuario->password =$password->password ;

                $usuario->hashPassword();

                $usuario->confirmado=1;
                $usuario->token='';

                $resultado=$usuario->guardar();

                if ($resultado){
                    header('Location: /');

                }else{
                    Usuario::setAlerta('error', 'No se logró confirmación');
                }


            }
            
        }

        $alertas= Usuario::getAlertas();
        

        $router->render('auth/recuperar-password',[
            'alertas'=>$alertas,
            'error'=>$error

        ]);
    }//recuperar


    public static function crear(Router $router){
        $usuario = new Usuario(); ///Para poder autocompletar los campos
        //cuando a un usuario le falto algun dato obligatoria, se crea la instacion vacía y
        //se pone en el html el value 
        $alertas=[];
        if ($_SERVER['REQUEST_METHOD'] ==='POST'){

            $usuario -> sincronizar($_POST);
            $alertas= $usuario->validarNuevaCuenta();



            //Revisar que alerta este vacío

            if (empty($alertas)){
                //verificar que el usuario no este registrado
                $resultado=$usuario->existeUsuario();

                
                if ( $resultado -> num_rows ){
                    //ya está registrado
                    $alertas = Usuario::getAlertas();
                    
                }else{
                    //No está registrado
                    //hashear el password

                    $usuario->hashPassword();

                    //Crear Token
                    
                    $usuario->crearToken();
                    
                    //Enviar email para confirmar el toke

                    $email= new Email($usuario->email,$usuario->nombre,$usuario->token);

                    $email->enviarConfirmacion();

                    //Crear el usuario

                    $resultado= $usuario->guardar();
                    if ($resultado){
                        header('Location: /mensaje');
                    }


                }

            }//empty


        }

        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }//recuperar



    public static function mensaje(Router $router){
        $router-> render('auth/mensaje');
    }//mensaje


    public static function confirmar(Router $router){
        $alertas=[];
        if (empty($_GET['token'])){
            header('Location: /');
        }
        $token=s($_GET['token']);
        
        $usuario=Usuario:: where('token',$token);
        if (empty($usuario)){
            Usuario::setAlerta('error', 'Token no Válido');

        }else{
            $usuario->confirmado=1;
            $usuario->token='';
       
            $resultado=$usuario->guardar();
            if ($resultado){

                Usuario::setAlerta('exito', 'Token  Válido, Usuario Confirmado');
            }else{
                Usuario::setAlerta('error', 'No se logró confirmación');
            }
            
        }
        $alertas=   Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas]);
    }
}//class LoginController