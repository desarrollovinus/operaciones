<?php
//incluyo funciones para conexion a la base de datos
include "funciones.php";
//me conecto a la base de datos
$link = Conectarse();
//obtengo el id de la abscisa pasado por post desde jquery
$id_abscisa=$_POST["elegido"];
//se arma la consulta con el id obtenido
$consulta = "select nombre from tbl_abscisas where id=$id_abscisa";
//se realiza la consulta
$resultado = mysql_query($consulta,$link);
//se obtiene en un array asociativo el resultado de la consulta
$datos = mysql_fetch_assoc($resultado);
//se selecciona la respuesta dentro del array
$nombre = $datos["nombre"];
//se cierra la conexion
mysql_close($link);
//se envia la respuesta
echo $nombre;
?>