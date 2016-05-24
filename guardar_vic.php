<?php
session_start();
include 'funciones.php';
$link=Conectarse();

$id_parte=$_SESSION["id_parte"];

$id_vic=$_POST["id_vic"];
$nombre=$_POST["nom_vic"];
$cedula=$_POST["ced_vic"];
$placa=$_POST["pla_vic"];
$estado=$_POST["estado_vic"];
$tipo=$_POST["rel_vic"];

$cons="update tbl_victimas set cedula='$cedula', placa_veh_vic='$placa', nombre_vic='$nombre',estado_vic='$estado', relacion_vic='$tipo'
       where id_parte='$id_parte' and id_vic='$id_vic'";
$res=mysql_query($cons, $link);


?>
<meta HTTP-EQUIV="REFRESH" content="0; url=selc_vic.php">
