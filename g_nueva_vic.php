<?php
session_start();
include 'funciones.php';

$con=$_POST['id_parte'];
$placa_vic=$_POST['pla_vic'];
$nombre=$_POST['nom_vic'];
$cedula=$_POST['ced_vic'];
$estado=$_POST['estado_vic'];
$relacion=$_POST['rel_vic'];


$link=Conectarse();

 $nuevo_inv="insert into tbl_victimas values ('','".$cedula."','".$con."','".$placa_vic."','".$nombre."','".$estado."','".$relacion."')";
 $resultado= mysql_query($nuevo_inv,$link);


?>
<meta HTTP-EQUIV="REFRESH" content="0; url=nueva_vic.php">