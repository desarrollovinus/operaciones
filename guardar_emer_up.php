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
$derra_sust=$_POST['derra_sust'];
$per_banca=$_POST['per_banca'];
$derr_via=$_POST['derr_via'];
$fuga_gas=$_POST['fuga_gas'];
$pro_orden=$_POST['pro_orden'];
$cai_puente=$_POST['cai_puente'];
$des_quebrada=$_POST['des_quebrada'];
$inundacion=$_POST['inundacion'];
$incendio=$_POST['incendio'];
$otros_em=$_POST['otros_em'];
$desc_eme=$_POST['desc_eme'];
$h_ini_emer=$_POST['h_ini_emer'];
$h_fin_emer=$_POST['h_fin_emer'];

 $crea_parte="update tbl_parte set motivo_parte='Emergencia' where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);


 $nuevo_reg="insert into tbl_emergencias values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$h_ini_emer."','".$h_fin_emer."','".$derra_sust."','".$per_banca."','".$pro_orden."','".$des_quebrada."','".$incendio."','".$derr_via."','".$fuga_gas."','".$cai_puente."','".$inundacion."','".$otros_em."','".$desc_eme."')";
 $res= mysql_query($nuevo_reg,$link);



?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
