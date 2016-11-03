<?php
//Se define la Zona Horaria
date_default_timezone_set("America/Bogota");

//Se importa el archivo de la clase
require("class.phpmailer.php");

function enviar($asunto, $cuerpo, $plantilla){
// function enviar($asunto, $cuerpo, $plantilla, $usuarios){
    
    //Se definen los usuarios a los que se enviara los correos
    // $usuarios = array("maribel.pena@hatovial.com", "monica.ochoa@hatovial.com"); //Se definen los usuarios a los que se enviara los correos
    $usuarios = array("johnarleycano@hotmail.com");


    /*
     * Declaramos variables que necesitaremos principalmente
     */
    $correo_sistema = "operaciones@vinus.com.co";
    $password_sistema = "opervinus2016";
    $servidor_correo = "mail.vinus.com.co";
    
    /*
     * Se crean las configuraciones
     */
    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = $correo_sistema;
    $mail->Password = $password_sistema;
    $mail->Host = $servidor_correo;
    $mail->From = $correo_sistema;
    $mail->FromName = utf8_decode("Concesión Vías del Nus - Operación y Mantenimiento");
    $mail->Subject = utf8_decode($asunto);
    
    //Se hace un recorrido por los usuarios a enviarles el correo
    for($w = 0; $w < count($usuarios); $w++){
        $mail->AddAddress(trim($usuarios[$w]));
    }
    
    // $mail->AddBCC("johnarleycano@hotmail.com");
    
    $mail->WordWrap = 50;
    
    /*
     * Se establece el cuerpo del mensaje, el cual es recibido por parametros
     */
    $mensaje = file_get_contents($plantilla);
    $mensaje = str_replace('{TITULO}', 'Concesión Vías del Nus - Operación y Mantenimiento', $mensaje);
    $mensaje = str_replace('{MENSAJE}', $cuerpo, $mensaje) ;

    $mail->Body = $mensaje;

    // Notificamos al usuario del estado del mensaje e inmediatamente se envia
    if(!$mail->Send()){ 
       echo "No se pudo enviar el Mensaje.";
    }else{ 
       echo "Mensaje enviado"; 
    }
}//Fin enviar()