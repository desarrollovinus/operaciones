<?php
//Se define la Zona Horaria
date_default_timezone_set("America/Bogota");

//Se carga el archivo de funciones
include '../funciones.php';

//Se carga el archivo de envio de email
include '../mail/enviar.php';

//Se establece la ruta de las fotos
$ruta = "files/";

//Se hace la consulta de todos los accidentescon la informacion que se pide
$consulta = mysql_query(
"SELECT
    tbl_accidente.id_parte,
    tbl_accidente.fec_pro,
    tbl_accidente.descripcion,
    CONCAT(tbl_usuarios.us_nombre,' ',tbl_usuarios.us_apellido) AS inspector
FROM
    tbl_accidente
    LEFT JOIN tbl_parte ON tbl_accidente.id_parte = tbl_parte.id_parte
    LEFT JOIN tbl_usuarios ON tbl_usuarios.id_usuario = tbl_parte.usuario
WHERE
    tbl_accidente.fotos = 0
ORDER BY
    tbl_accidente.id_parte ASC", Conectarse());

/*
 * Se construye la tabla que se va a enviar
 */
/********************************tabla********************************/
$tabla = '<table border="1" bordercolor="white" cellspacing="0" width="100%">';
    /********************************cabecera********************************/
    $tabla .= '<thead border="1" bordercolor="black" style="background-color:#C8D7DC; font-family:Tahoma; color: black; font-size: 13px;" width="100%">';
    $tabla .= '<tr>';
    $tabla .= '<th width="5%">Parte</th>';
    $tabla .= '<th width="10%">Fecha de Creación</th>';
    $tabla .= '<th width="15%">Inspector</th>';
    $tabla .= '</tr>';
    $tabla .= '</thead>';

    /********************************cuerpo********************************/
    $tabla .= '<tbody style="font-family:Tahoma; font-size: 12px;">';
        while ( $row = mysql_fetch_array($consulta)){
            //Se recorre cada carpeta en busca de imagenes
            foreach(glob($ruta.$row['id_parte']."/*") as $archivo){
                //se aumenta el contador de imagenes
                $numero_archivos++;
            }

            //Se pone un 1 a todos los accidentes que tienen fotos
            if($numero_archivos != 0){
                //Consulta que hara el update
                $insercion = "update tbl_accidente set fotos = 1 where id_parte = ".$row['id_parte'];
                //Ejecucion de la consulta
                mysql_query($insercion, Conectarse());
            }

            $tabla .= '<tr bordercolor="black">';
            $tabla .= '<td align="right">'.$row['id_parte'].'</td>';
            $tabla .= '</td>';
            $tabla .= '<td align="right">'.$row['fec_pro'].'&nbsp;</td>';
            $tabla .= '</td>';
            $tabla .= '<td>'.$row['inspector'].'</td>';
            $tabla .= '</td>';
            $tabla .= '</tr>';
        }
    $tabla .= '</tbody>';
$tabla .= '</table>';

//Se define el asunto y el mensaje que se enviara. En este caso, la tabla se envia dentro del mensaje
$asunto = "Accidentes sin registro fotográfico";

if(mysql_num_rows($consulta) == 0){
    $mensaje = utf8_decode("A la fecha no hay accidentes sin registro fotográfico");
}else{
    $mensaje = utf8_decode("A la fecha hay ".number_format(mysql_num_rows($consulta), 0, '', '.')." accidentes que no tienen registro fotográfico. Este es el listado correspondiente:<br/>".$tabla);
}

$plantilla = "plantilla_email.html";

$usuarios = array("maribel.pena@hatovial.com", "monica.ochoa@hatovial.com", "juan.gonzalez@hatovial.com");                                //Se definen los usuarios a los que se enviara los correos
//$usuarios = array("john.cano@hatovial.com");        //Se definen los usuarios a los que se enviara los correos

//Se envia el email
enviar($asunto, $mensaje, $plantilla, $usuarios);
?>