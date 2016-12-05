<?php
session_start();
include 'funciones.php';
$link=Conectarse();


$fechahora=$_POST['fecha'];
$id_parte=$_POST['id_parte'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$radiooperador=$_POST['radiooperador'];
$abcisa=$_POST['abcisa'];
$nom_inv=$_POST['nom_inv'];
$color_veh=$_POST['color_veh'];
$ced_inv=$_POST['ced_inv'];
$antendido=$_POST['atendido'];
$motivo_atencion=$_POST['motivo_atencion'];
$marca_veh=$_POST['marca_veh'];
$tel_inv=$_POST['tel_inv'];
$servicio_veh=$_POST['servicio_veh'];
$placa_veh=$_POST['placa_veh'];
$tipo_veh=$_POST['tipo_veh'];

//Campos no utulizados pero con datos en B.D
$acc_trab=$_POST['acc_trab'];
$escom_via=$_POST['escom_via'];
$per_muerta=$_POST['per_muerta'];
$obs_via=$_POST['obs_via'];
$pri_aux=$_POST['pri_aux'];
$sem_muerto=$_POST['sem_muerto'];
$veh_abandonado=$_POST['veh_abandonado'];
$veh_varado=$_POST['veh_varado'];
$veh_inmov=$_POST['veh_inmov'];
$serv_inc=$_POST['serv_inc'];
//--------------------------------------------

$tipo_inc=$_POST['tipo_inc'];
$desc_inc=$_POST['desc_inc'];
$h_ini_inc=$_POST['h_ini_inc'];
$h_fin_inc=$_POST['h_fin_inc'];


$act_reg = "update tbl_incidente set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', h_ini_inc='$h_ini_inc', h_fin_inc='$h_fin_inc', us_nombre='$nom_inv', us_ced='$ced_inv', us_tel='$tel_inv', us_placa_veh='$placa_veh',
us_color_veh='$color_veh', us_marca_veh='$marca_veh', us_serv_veh='$servicio_veh', us_tipo_veh='$tipo_veh', acc_trabajo='$acc_trab', per_muerta_via='$per_muerta', prim_aux='$pri_aux', veh_aban='$veh_abandonado', veh_inmov='$veh_inmov',
escom_via='$escom_via', obs_via='$obs_via', sem_muerto='$sem_muerto', veh_varado='$veh_varado', otros='$serv_inc', tipo_inc='$tipo_inc', descrip='$desc_inc' where id_parte=$id_parte ";

$act_reg2 = "update tbl_parte set atendido='$antendido', id_motivo_atencion='$motivo_atencion', id_radiooperador=$radiooperador where id_parte=$id_parte ";

echo $act_reg2;

$res= mysql_query($act_reg,$link);
$res2= mysql_query($act_reg2,$link);


?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
