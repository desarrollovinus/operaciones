<?php
session_start();
include 'funciones.php';
include 'mail/enviar.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

// Se recolectan las variables
$id_parte=$_POST['id_parte'];
$nombre_usuario=$_POST['nombre_usuario'];
$telefono_usuario=$_POST['telefono_usuario'];
$tipo_servicio=$_POST['tipo_servicio'];
$email_usuario=$_POST['email_usuario'];
$fecha_hora=date("Y-m-d h:i:s");

// Se realiza la inserción
$nuevo = "insert into tbl_encuestas values ('', '$id_parte', '$nombre_usuario', '$telefono_usuario', '$tipo_servicio', '$email_usuario', '$fecha_hora', '$ced')";
mysql_query($nuevo,$link);

// Se retorna el id creado
echo mysql_insert_id();
