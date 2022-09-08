<?php
// https://github.com/PHPMailer/PHPMailer, en la pagina se ubica composer require phpmailer/phpmailer y se instala 
//desde la terminal, creandose la carpeta vendor/phpmailer  y ale¿ final hay un ejemplo con todo el codigo
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }


    public function enviarConfirmacion(){
        //Crear el objeto de Email
        $mail= new PHPMailer;
        //Server settings
        // se puede buscar este código en Mailtrap inboxes
        
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '5fe06c7cc95b92';
        $mail->Password = 'ae74504aefe205';


         //Recipients
         $mail->setFrom('cuentas@appsalon.com', 'Mailer'); ///dominio propio
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');     //Add a recipient
        
        //Contenido
        $mail->Subject = 'Confirma tu cuenta';
        
        $mail->isHTML(TRUE);                                  //Set email format to HTML
        $mail-> CharSet='UTF-8';
        
       $contenido  ="<html>";
       
       $contenido .="<p><strong>Hola"  . $this->nombre . "</strong> Has creado tu cuenta en AppSalon solo tienes que confirmarla en el siuiente enlace</p>";
       
       $contenido .= "<p> Presiona aquí: <a href= 'http://localhost:3000/confirmar-cuenta?token=" . $this->token ."'>Confirmar Cuenta </a> </p>";
      
       $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
       
       $contenido .= "</html>";
      
       $mail->Body = $contenido;
  

        //enviar email
        $mail->send();


    }//enviar Confirmacion

    public function enviarInstrucciones(){
        //Crear el objeto de Email
        $mail= new PHPMailer;
        //Server settings
        // se puede buscar este código en Mailtrap inboxes
        
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '5fe06c7cc95b92';
        $mail->Password = 'ae74504aefe205';


         //Recipients
         $mail->setFrom('cuentas@appsalon.com', 'Mailer'); ///dominio propio
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');     //Add a recipient
        
        //Contenido
        $mail->Subject = 'Reestablece Tu Password';
        
        $mail->isHTML(TRUE);                                  //Set email format to HTML
        $mail-> CharSet='UTF-8';
        
       $contenido  ="<html>";
       
       $contenido .="<p><strong>Hola"  . $this->nombre . "</strong> Has solicitado reestablecer tu password en AppSalon solo tienes que confirmarla en el siguiente enlace</p>";
       
       $contenido .= "<p> Presiona aquí: <a href= 'http://localhost:3000/recuperar?token=" . $this->token ."'> Reestablecer tu password </a> </p>";
      
       $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
       
       $contenido .= "</html>";
      
       $mail->Body = $contenido;
  

        //enviar email
        $mail->send();


    }//enviar Instrucciones
}