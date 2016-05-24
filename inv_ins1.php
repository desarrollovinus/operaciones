<?php

include 'funciones.php';

$con=$_POST['id_parte'];
$nombre=$_POST['nom_inv'];
$cedula=$_POST['ced_inv'];
$telefono=$_POST['tel_inv'];
$celular=$_POST['cel_inv'];
$placa_inv=$_POST['placa_inv'];
$color_veh=$_POST['color_veh'];
$marca_veh=$_POST['marca_veh'];
$servicio_veh=$_POST['servicio_veh'];
$tipo_veh=$_POST['tipo_veh'];
$cilindraje_veh=$_POST['cilindraje_veh'];

$link=Conectarse();


 $nuevo_inv="insert into tbl_involucrados values ('','".$cedula."','$con','".$nombre."','".$telefono."','".$celular."','".$placa_inv."','".$color_veh."','".$marca_veh."','".$servicio_veh."','".$tipo_veh."','".$cilindraje_veh."' )";
 $resultado= mysql_query($nuevo_inv,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="0; url=selc_inv.php">