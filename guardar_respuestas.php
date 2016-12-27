<?php
session_start();
include 'funciones.php';
include 'mail/enviar.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

// Se recolectan las variables
$id_encuesta=$_POST['id_encuesta'];
$respuestas=$_POST['datos'];

// Se recorren las respuestas
foreach ($respuestas as $respuesta) {
	// Se realiza la inserción de cada respuesta
	$nuevo = "insert into tbl_respuestas values ('', '$id_encuesta', '$respuesta[id_pregunta]', '$respuesta[valor]')";
	mysql_query($nuevo,$link);
}

echo true
?>