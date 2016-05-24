<?php
session_start();
include 'funciones.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

$id_parte=$_POST['id_parte'];
$fechahora=$_POST['fecha'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$desc_otros=$_POST['desc_otros'];
$h_ini_otros=$_POST['h_ini_otros'];
$h_fin_otros=$_POST['h_fin_otros'];


 $crea_parte="update tbl_parte set motivo_parte='Otros', usuario='$ced' where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);

 $act="update tbl_otros set id_parte='$id_parte', via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', h_ini_otros='$h_ini_otros', h_fin_otros='$h_fin_otros', descrip='$desc_otros'";
 $res=  mysql_query($act,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="10; url=menu_insp.php">