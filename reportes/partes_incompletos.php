<?php
//Se define la Zona Horaria
date_default_timezone_set("America/Bogota");

//Se carga el archivo de funciones
include '../funciones.php';

//Se carga el archivo de envio de email
include '../mail/enviar.php';

//Se hace la consulta de todos los accidentescon la informacion que se pide
$consulta = mysql_query(
"SELECT
    tbl_parte.id_parte,
    tbl_parte.fechahora,
    CONCAT(tbl_usuarios.us_nombre,' ',tbl_usuarios.us_apellido) AS inspector,
    tbl_parte.motivo_parte,
    DATEDIFF(CURDATE(), tbl_parte.fechahora) AS dias_vencido
FROM
    tbl_parte
    LEFT JOIN tbl_usuarios ON tbl_usuarios.id_usuario = tbl_parte.usuario
WHERE
    tbl_parte.fechahora BETWEEN '".date("Y")."-01-01' AND DATE_ADD(NOW(), INTERVAL -2 DAY)
ORDER BY
    tbl_parte.id_parte DESC", Conectarse());

/*
 * Se construye la tabla que se va a enviar
 */
/********************************tabla********************************/
$tabla = '<table border="1" bordercolor="white" cellspacing="0" width="100%">';
    /********************************cabecera********************************/
    $tabla .= '<thead border="1" bordercolor="black" style="background-color:#C8D7DC; font-family:Tahoma; color: black; font-size: 13px;" width="100%">';
    $tabla .= '<tr>';
    $tabla .= '<th>Parte</th>';
    $tabla .= '<th>Fecha de Creación</th>';
    $tabla .= '<th>Inspector</th>';
    $tabla .= '<th>Motivo</th>';
    $tabla .= '<th>Días vencido</th>';
    $tabla .= '</tr>';
    $tabla .= '</thead>';
    
    /********************************cuerpo********************************/
    $tabla .= '<tbody style="font-family:Tahoma; font-size: 12px;">';
    $contador = 0;
    $conexion = Conectarse();
        while ($row = mysql_fetch_array($consulta)){
            $parte = $row['id_parte'];
            //if((accidente_incompleto($parte, $conexion) != true)){
            if($row['motivo_parte'] == 'Accidente'){
                if(accidente_incompleto($parte, $conexion)){
                    $contador++;
                    $tabla .= '<tr bordercolor="black">';
                    $tabla .= '<td align="right">'.$row['id_parte'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td align="right">'.$row['fechahora'].'&nbsp;</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td>'.$row['inspector'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td>'.$row['motivo_parte'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td align="right">'.$row['dias_vencido'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '</tr>';
                }
           }
           if($row['motivo_parte'] == 'Incidente'){
               if(incidente_incompleto($parte, $conexion)){
                   $contador++;
                    $tabla .= '<tr bordercolor="black">';
                    $tabla .= '<td align="right">'.$row['id_parte'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td align="right">'.$row['fechahora'].'&nbsp;</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td>'.$row['inspector'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td>'.$row['motivo_parte'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '<td align="right">'.$row['dias_vencido'].'</td>';
                    $tabla .= '</td>';
                    $tabla .= '</tr>';
                }    
            }
        }
    $tabla .= '</tbody>';
$tabla .= '</table>';

//Se define el asunto y el mensaje que se enviara. En este caso, la tabla se envia dentro del mensaje
$asunto = "Informe de accidentes incompletos";

if($contador == 0){
    $mensaje = utf8_decode("Los partes creados desde el 01-01-".date("Y")." y hasta el ".date("d-m-Y", strtotime(date()."-2 day"))." están completos.");
}else{
    $mensaje = utf8_decode("Desde el 01-01-".date("Y")." hasta el ".date("d-m-Y", strtotime(date()."-2 day"))." existen ".number_format($contador, 0, '', '.')." partes incompletos. Este es el listado correspondiente:".$tabla);
}

$plantilla = "plantilla_email.html";

$usuarios = array("monica.ochoa@hatovial.com, juan.gonzalez@hatovial.com");                                //Se definen los usuarios a los que se enviara los correos
//$usuarios = array("john.cano@hatovial.com");        //Se definen los usuarios a los que se enviara los correos

//Se envia el email
enviar($asunto, $mensaje, $plantilla, $usuarios);
?>
