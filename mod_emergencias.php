<?php
session_start();
include 'funciones.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

$id_parte=$_POST['id_parte'];
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



$act_reg="update tbl_emergencias set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa',
 h_ini_emer='$h_ini_emer', h_fin_emer='$h_fin_emer', derr_sustancias='$derra_sust', perd_banca='$per_banca', prob_orden='$pro_orden', desb_queb='$des_quebrada',
incendio='$incendio', derr_via='$derr_via', fuga_gas='$fuga_gas', caida_puente='$cai_puente', inundacion='$inundacion', otros='$otros_em', descrip='$desc_eme' where id_parte=$id_parte ";

 $res= mysql_query($act_reg,$link);

echo $act_reg;

?>
<meta HTTP-EQUIV="REFRESH" content="5; url=menu_insp.php">

