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
		p.id_parte,
		p.conc_bit,
		p.fechahora,
		p.motivo_parte,
		p.cierre_via,
		p.ambulancia,
		p.grua,
		p.usuario,
		p.atendido,
		p.id_motivo_atencion,
		CONCAT(
			u.us_nombre,
			' ',
			u.us_apellido
		) AS inspector
	FROM
		tbl_parte AS p
	INNER JOIN tbl_usuarios AS u ON p.usuario = u.id_usuario
	WHERE
		p.atendido = 0
	AND p.id_motivo_atencion = 0
	ORDER BY
		p.id_parte DESC", Conectarse()
);

/*
 * Se construye la tabla que se va a enviar
 */
/********************************tabla********************************/
$tabla = '<table border="1" bordercolor="white" cellspacing="0" width="100%">';
    /********************************cabecera********************************/
    $tabla .= '<thead border="1" bordercolor="black" style="background-color:#C8D7DC; font-family:Tahoma; color: black; font-size: 13px;" width="100%">';
    $tabla .= '<tr>';
    $tabla .= '<th>Parte</th>';
    $tabla .= '<th>Tipo</th>';
    $tabla .= '<th>Fecha de Creación</th>';
    $tabla .= '<th>Inspector</th>';
    $tabla .= '</tr>';
    $tabla .= '</thead>';
   
    /********************************cuerpo********************************/
    $tabla .= '<tbody style="font-family:Tahoma; font-size: 12px;">';
		$contador = 0;
	    $conexion = Conectarse();
	    while ($row = mysql_fetch_array($consulta)){
	    	$parte = $row['id_parte'];
	    	$contador++;

	    	$tabla .= '<tr bordercolor="black">';
	    	$tabla .= '<td align="right">'.$row['id_parte'].'</td>';
	    	$tabla .= '<td>'.$row['motivo_parte'].'</td>';
            $tabla .= '<td align="right">'.$row['fechahora'].'&nbsp;</td>';
            $tabla .= '<td>'.$row['inspector'].'</td>';
            $tabla .= '</tr>';
	    } // while
    $tabla .= '</tbody>';
$tabla .= '</table>';

//Se define el asunto y el mensaje que se enviara. En este caso, la tabla se envia dentro del mensaje
$asunto = "Informe de partes sin atención";

if($contador == 0){
    $mensaje = utf8_decode("A la fecha no hay partes que no hayan sido atendidos y no se haya explicado el motivo.");
}else{
    $mensaje = utf8_decode("A la fecha existen ".number_format($contador, 0, '', '.')." partes sin atención y los cuales no se ha especificado el motivo de la no asistencia. Este es el listado correspondiente:".$tabla);
}

$plantilla = "plantilla_email.html";

$usuarios = array("monica.ochoa@hatovial.com, juan.gonzalez@hatovial.com");                                //Se definen los usuarios a los que se enviara los correos
// $usuarios = array("john.cano@hatovial.com");        //Se definen los usuarios a los que se enviara los correos

//Se envia el email
enviar($asunto, $mensaje, $plantilla, $usuarios);
?>