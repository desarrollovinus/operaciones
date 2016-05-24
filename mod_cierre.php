<?php
include 'funciones.php';
$link=Conectarse();


$id_parte=$_POST['id_parte'];
$hora_ini=$_POST['h_ini_cie'];
$hora_fin=$_POST['h_fin_cie'];
$amb=$_POST['amb'];
$grua=$_POST['grua'];
$agen_tran=$_POST['age_tran'];
$sena=$_POST['sena'];
$pol_nal=$_POST['pol_nal'];
$bomberos=$_POST['bom'];
$def_civil=$_POST['def_civil'];
$fiscalia=$_POST['fisc'];
$dir_oper=$_POST['dir_ope'];
$pol_car=$_POST['pol_car'];
$insp_vial=$_POST['ins_vial'];
$pol_tran=$_POST['pol_tran'];
$mante=$_POST['mant'];
$res_oper=$_POST['res_ope'];
$otros_serv=$_POST['otros_ser'];
$desc=$_POST['desc_hechos'];


$act_reg="update tbl_cierre set fechahoraini='".$hora_ini."', fechahorafin='$hora_fin', amb='$amb', agen_tran='$agen_tran', pol_nal='$pol_nal',
def_civil='$def_civil', dir_ope='$dir_oper', insp_vial='$insp_vial', mant='$mante', otros='$otros_serv', grua_con='$grua', sena='$sena',
bom='$bomberos', fiscalia='$fiscalia', pol_car='$pol_car', pol_tran='$pol_tran', res_ope='$res_oper', descrip='$desc' where id_parte=$id_parte ";

 $res= mysql_query($act_reg,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="0 url=menu_insp.php">