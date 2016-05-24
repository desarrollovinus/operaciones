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


$act_reg= "update tbl_parte set cierre_via=1 where id_parte=$id_parte";
$resultado= mysql_query($act_reg,$link);


 $nuevo_reg="insert into tbl_cierre values ('','".$id_parte."','".$hora_ini."','".$hora_fin."','".$amb."','".$agen_tran."','".$pol_nal."','".$def_civil."','".$dir_oper."','".$insp_vial."','".$mante."','".$otros_serv."','".$grua."','".$sena."','".$bomberos."','".$fiscalia."','".$pol_car."','".$pol_tran."','".$res_oper."','".$desc."')";
 $res= mysql_query($nuevo_reg,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="0 url=menu_insp.php">
