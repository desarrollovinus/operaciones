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
$punto=$_POST['punto'];
$nom_via=$_POST['nom_via'];
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

$_SESSION["id_parte"]=$id_parte;

 $crea_parte="update tbl_parte set motivo_parte='Accidente', usuario='".$ced."'  where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);
 echo $crea_parte;

 $nuevo_reg="insert into tbl_accidente values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$punto."','".$nom_tramo."','".$fec_pro."','".$fec_con."','".$fecha_ini."','".$fecha_fin."','".$car_obs."','".$fuego."','".$dano_obra."','".$ch_veh."','".$atrop."','".$cai_ocup."','".$ch_metro."','".$ch_obj."','".$volca."','".$ch_semo."','".$otros_acc."','".$amb."','".$grua."','".$agen_tran."','".$sena."','".$pol_nal."','".$bomberos."','".$def_civil."','".$fiscalia."','".$dir_oper."','".$pol_car."','".$insp_vial."','".$pol_tran."','".$mante."','".$res_oper."','".$otros_serv."','".$ilum."','".$rod."','".$rod_lim."','".$trafico."','".$dano_aut."',
     '".$embri."','".$exc_vel."','".$fallas."','".$falta_pre."','".$no_dis."','".$obs_via."','".$sup_hum."',
     '".$ade_proh."','".$imp_con."','".$mal_est."','".$imp_peat."','".$contravia."','".$sem_via."','".$obras_via."',
     '".$huecos_via."','".$hip_otros."','".$desc."')";
 $res= mysql_query($nuevo_reg,$link);
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=involucrados.php">
