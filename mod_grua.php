<?php
session_start();
include 'funciones.php';
$link=Conectarse();

$id_parte=$_POST['id_parte'];
$id_grua=$_POST['id_grua'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];

$h_ped=$_POST["h_ped"];
$h_ini_grua=$_POST['h_ini_grua'];
$h_fin_grua=$_POST['h_fin_grua'];

$nom_inv=$_POST['nom_inv'];
$color_veh=$_POST['color_veh'];
$ced_inv=$_POST['ced_inv'];
$marca_veh=$_POST['marca_veh'];
$tel_inv=$_POST['tel_inv'];
$servicio_veh=$_POST['servicio_veh'];
$placa_veh=$_POST['placa_veh'];
$tipo_veh=$_POST['tipo_veh'];

                        //Campos no utilizados pero con datos en la B.D (modificacion 31/08/2011)
                        $acc=$_POST['acc'];
                        $traslado=$_POST['traslado'];
                        $varado=$_POST['varado'];
                        $sena=$_POST['sena'];
                        $inmov=$_POST['inmov'];
                        $apoyo_pre=$_POST['apoyo_pre'];
                        $apoyo_mot=$_POST['apoyo_mot'];
                        $otro_pres=$_POST['otro_pres'];
                        $otro_mot=$_POST['otro_mot'];
                        //----------------------------------------------------------------------


$mot_serv=$_POST['mot_serv'];
$serv_pres=$_POST['serv_pres'];

$aut_mov=$_POST['aut_mov'];
$excelente=$_POST['excelente'];
$calidad=$_POST['calidad'];
$bueno=$_POST['bueno'];
$nom_fin=$_POST['nom_fin'];
$lug_fin=$_POST['lug_fin'];
$regular=$_POST['regular'];
$tipo_grua=$_POST['tipo_grua'];


$malo=$_POST['malo'];
$oper_grua=$_POST['oper_grua'];
$desc_grua=$_POST['desc_grua'];


$act_reg="update tbl_grua set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', h_ped='$h_ped', fechahorainicio='$h_ini_grua',
fechahorafin='$h_fin_grua', nom_us='$nom_inv', ced_us='$ced_inv', tel_us='$tel_inv', placa_veh='$placa_veh', color_veh='$color_veh', marca_veh='$marca_veh',
serv_veh='$servicio_veh', tipo_veh='$tipo_veh', acc='$acc', varado='$varado', inmovilizado='$inmov', apoyo_mot='$apoyo_mot', otros_mot='$otro_mot',
traslado='$traslado', sena='$sena', apoyo_pres='$apoyo_pre', otros_pres='$otro_pres', mot_serv='$mot_serv', serv_pres='$serv_pres', autoriza_mov='$aut_mov', en_calidad_de='$calidad',
nom_fin='$nom_fin', lug_fin='$lug_fin', tipo_grua='$tipo_grua', excelente='$excelente', bueno='$bueno', regular='$regular', malo='$malo', oper_grua='$oper_grua',
desc_grua='$desc_grua' where id_parte='$id_parte' and id_grua='$id_grua' ";

 $res= mysql_query($act_reg,$link);


?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
