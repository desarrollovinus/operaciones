<?php
//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();
include 'funciones.php';
$link=Conectarse();



$id_parte=$_SESSION["id_parte"];


//Se captura los dato del formulario que esta en el mod_invo.php.php
$id_inv=$_POST["id_inv"];
$nombre=$_POST["nom_inv"];
$cedula=$_POST["ced_inv"];
$telefono=$_POST["tel_inv"];
$celular=$_POST["cel_inv"];
$placa=$_POST["placa_inv"];
$color=$_POST["color_veh"];
$marca=$_POST["marca_veh"];
$servicio=$_POST["servicio_veh"];
$tipo=$_POST["tipo_veh"];
$cilindraje_veh=$_POST['cilindraje_veh'];

// SE HACE LA ACTUALIZACIÓN A LA TABLA DE INVOLUCRADOS
$cons="update tbl_involucrados set cedula='$cedula', nombre='$nombre', telefono='$telefono', celular='$celular',
        placa_veh='$placa', color_veh='$color', marca_veh='$marca', servicio_veh='$servicio', tipo_veh='$tipo', cilindraje='$cilindraje_veh'
        where id_parte='$id_parte' and id_inv='$id_inv'";
$res=mysql_query($cons, $link);


?>
<meta HTTP-EQUIV="REFRESH" content="0; url=selc_inv.php">

