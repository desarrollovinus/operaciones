<?php
include 'funciones.php';
include 'mail/enviar.php';

    #$consecutivo=$_POST['consecutivo'];
    $fechahora=$_POST['fecha'];
    $motivo=$_POST['com_motivo'];
    $asunto=$_POST['asunto'];
    $heridos=$_POST['com_heridos'];
    $reporto=$_POST['per_reporta'];
    $danos=$_POST['danos'];
    $ubicacion=$_POST['ubi_reportada'];
    $emisor=$_POST['emisor'];
    $importancia=$_POST['importancia'];
    $anotacion=$_POST['anotacion'];
    $ced=$_POST['ced'];
    
    $link=Conectarse();
    //----------------actualiza la bitacora con los datos insertados--------------------------------------//
   // $act_reg= "update tbl_bitacora set motivo='$motivo', asunto='$asunto', heridos='$heridos', reporto='$reporto', danos='$danos', ubicacion='$ubicacion', emisor='$emisor', importancia='$importancia', anotacion='$anotacion' where consecutivo=$consecutivo ";
    //$resultado= mysql_query($act_reg,$link);

    $nuevo_reg="insert into tbl_bitacora values ('','','".$fechahora."','".$motivo."','".$asunto."','".$heridos."','".$reporto."','".$danos."','".$ubicacion."','".$emisor."','".$importancia."','".$anotacion."','".$ced."')";
    
    $resultado= mysql_query($nuevo_reg,$link);
    
    
    $consecutivo = mysql_insert_id();                   //Se obtiene el numero de consecutivo
    $plantilla = "reportes/plantilla_email.html";       //Se envia la ruta de la plantilla para el correo
    
    //Cuando sea un accidente
    if($motivo == 'accidente'){
        //Se preparan los datos a enviar
        $mensaje = utf8_decode("Se ha registrado un accidente en bitácora (".$asunto.") con el número de consecutivo ".$consecutivo.":<br/><br/>".$anotacion);
        $asunto = "Informativo: Reporte de accidente";
        
        if($emisor){
            $mensaje .= "<br/><br/>El accidente fue reportado por medio de ".$emisor."</br></br>";
        }
        
        //Se ejecuta la funcion que envia el email
        enviar($asunto, $mensaje, $plantilla);
    }
    
    //Cuando el accidente se cancele
    if($motivo == 'accidente_cancelado'){
        //Se preparan los datos a enviar
        $mensaje = utf8_decode("Cancelación reporte de accidente (".$asunto.") con la siguiente descripci&oacute;n:<br/><br/>".$anotacion);
        $asunto = "Reporte Cancelado";
        
        //Se ejecuta la funcion que envia el email
        enviar($asunto, $mensaje, $plantilla);
    }
 ?>
<meta HTTP-EQUIV="REFRESH" content="0; url=querys.php">