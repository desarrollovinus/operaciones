<?php
session_start();
include 'funciones.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

$id_parte=$_POST['id_parte'];
$radiooperador=$_POST['radiooperador'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$punto=$_POST['punto'];
$antendido=$_POST['atendido'];
$motivo_atencion=$_POST['motivo_atencion'];
$nom_tramo=$_POST['nom_tramo'];
$fecha_ini=$_POST['fec_ini'];
$fecha_fin=$_POST['fec_fin'];
$fec_pro=$_POST['fec_pro'];
$fec_con=$_POST['fec_con'];
$car_obs=$_POST['c_obs'];
$fuego=$_POST['fuego'];
$dano_obra=$_POST['dano_via'];
$ch_veh=$_POST['choque_veh'];
$atrop=$_POST['atrop'];
$cai_ocup=$_POST['cai_ocu'];
$ch_metro=$_POST['ch_tren'];
$ch_obj=$_POST['ch_obj'];
$volca=$_POST['volc'];
$ch_semo=$_POST['ch_sem'];
$otros_acc=$_POST['otro_acc'];
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
$otros_serv=$_POST['serv_otros'];
$ilum=$_POST['ilum_cond'];
$rod=$_POST['rod_cond'];
$rod_lim=$_POST['rodlim_cond'];
$trafico=$_POST['traf_cond'];
$dano_aut=$_POST['danos_cond'];
$hipo=$_POST['hipotesis'];
$desc=$_POST['desc_hechos'];

$embri=$_POST['embri'];
$exc_vel=$_POST['exc_vel'];
$fallas=$_POST['fallas'];
$falta_pre=$_POST['falta_pre'];
$no_dis=$_POST['no_dis'];
$obs_via=$_POST['obs_via'];
$sup_hum=$_POST['sup_hum'];
$ade_proh=$_POST['ade_proh'];
$imp_con=$_POST['imp_con'];
$mal_est=$_POST['mal_est'];
$imp_peat=$_POST['imp_peat'];
$contravia=$_POST['contravia'];
$sem_via=$_POST['sem_via'];
$obras_via=$_POST['obras_via'];
$huecos_via=$_POST['huecos_via'];
$hip_otros=$_POST['hip_otros'];


$act_reg="update tbl_accidente set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', punto_referencia='$punto',
nombre_tramo='$nom_tramo', fec_pro='$fec_pro', fec_con='$fec_con', fechahora_ini='$fecha_ini', fechahora_fin='$fecha_fin', carriles_obs='$car_obs', fuego='$fuego',
danos_obra='$dano_obra', ch_contra_veh='$ch_veh', atropello='$atrop', caida_del_ocu='$cai_ocup', ch_contra_metro='$ch_metro', ch_contra_obj='$ch_obj',
volcamiento='$volca', ch_contra_sem='$ch_semo', otros_acc='$otros_acc', ambulancia='$amb', grua_con='$grua', agentes_trans='$agen_tran', senalizacion='$sena',
policia_nal='$pol_nal', bomberos='$bomberos', defensa_civil='$def_civil', fiscalia='$fiscalia', director_ope='$dir_oper', policia_carreteras='$pol_car',
insp_vial='$insp_vial', policia_trans='$pol_tran', mantenimiento='$mante', residente_ope='$res_oper', otros_serv='$otros_serv', iluminacion='$ilum',
rodadura='$rod', roda_lim='$rod_lim', trafico='$trafico', danos_auto='$dano_aut',
embri='$embri', exc_vel='$exc_vel', fallas='$fallas', falta_pre='$falta_pre', no_dis='$no_dis', obs_via='$obs_via', sup_hum='$sup_hum', ade_proh='$ade_proh',
imp_con='$imp_con', mal_est='$mal_est', imp_peat='$imp_peat', contravia='$contravia', sem_via='$sem_via', obras_via='$obras_via',
huecos_via='$huecos_via', hip_otros='$hip_otros', descripcion='$desc' where id_parte=$id_parte ";

$act_reg2 = "update tbl_parte set atendido='$antendido', id_motivo_atencion='$motivo_atencion', id_radiooperador=$radiooperador where id_parte=$id_parte ";

echo $act_reg2;
$res= mysql_query($act_reg,$link);
$res2= mysql_query($act_reg2,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">
