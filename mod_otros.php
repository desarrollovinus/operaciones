<?php
session_start();
include 'funciones.php';
$link=Conectarse();

$id_parte=$_POST['id_parte'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$desc_otros=$_POST['desc_otros'];
$h_ini_otros=$_POST['h_ini_otros'];
$h_fin_otros=$_POST['h_fin_otros'];


$act_reg="update tbl_otros set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', h_ini_otros='$h_ini_otros', h_fin_otros='$h_fin_otros', descrip='$desc_otros' where id_parte=$id_parte ";

$res= mysql_query($act_reg,$link);
?>
<meta HTTP-EQUIV="REFRESH" content="5; url=menu_insp.php">