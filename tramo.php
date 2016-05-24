<?php
//incluyo funciones para conexion a la base de datos
include "funciones.php";
//me conecto a la base de datos
$link = Conectarse();
//obtengo el id del tramo pasado por post desde jquery
$id_tramo=$_POST["elegido"];
//se arma la consulta con el id obtenido
$consulta = "select nombre,via from tbl_tramos where id=$id_tramo";
//se realiza la consulta
$resultado = mysql_query($consulta,$link);
//se obtiene en un array asociativo el resultado de la consulta
$datos_tramo = mysql_fetch_assoc($resultado);
//armo la cadena de la respuesta.
$respuesta = $datos_tramo["nombre"]."|".$datos_tramo["via"];
//armo la consulta para determinarlas abscisas asociadas a ese tramo
$consulta = "select id,abscisa from tbl_abscisas where tramo=$id_tramo";
//obtengo el resultado de la consulta
$resultado = mysql_query($consulta,$link);
//armo la respuesta usando un array asociativo por registro
while($datos_abscisas = mysql_fetch_assoc($resultado)){
	$respuesta.="|".$datos_abscisas["id"]."|".$datos_abscisas["abscisa"];
}
//se cierra la conexion
mysql_close($link);
//se envia la respuesta
echo $respuesta;
?>