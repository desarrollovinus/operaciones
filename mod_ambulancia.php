<?php
session_start();
include 'funciones.php';
$link=Conectarse();


$id_amb=$_POST['id_amb'];
$id_parte=$_POST['id_parte'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];

$h_ped=$_POST['h_ped'];
$h_llegada=$_POST['h_lleg'];
$h_atencion=$_POST['h_aten'];
$h_rec=$_POST['h_rec'];

$nom_inv=$_POST['nom_inv'];
$dir_res=$_POST['dir_res'];
$ced_inv=$_POST['ced_inv'];
$aseg=$_POST['aseg'];
$tel_inv=$_POST['tel_inv'];
$nomb_acomp=$_POST['nomb_acomp'];
$placa_veh=$_POST['placa_veh'];
$tel_acomp=$_POST['tel_acomp'];


  //-----------------campos no utilizados pero con datos en la B.D
                    $enf_gen=$_POST['enf_gen'];
                    $lesion_agre=$_POST['lesion_agre'];
                    $vict_danos=$_POST['vict_danos'];
                    $castastrofe=$_POST['castastrofe'];
                    $acc_tran=$_POST['acc_tran'];
                    $acc_comun=$_POST['acc_comun'];
                    $acc_trab=$_POST['acc_trab'];
                    $otros_cau=$_POST['otros_cau'];
                    //-------------------------------------------------------

$mfs=$_POST['mfs'];
$smc=$_POST['smc'];
$srg=$_POST['srg'];
$svpb=$_POST['svpb'];
$febdm=$_POST['febdm'];
$cnvn=$_POST['cnvn'];
$stb=$_POST['stb'];
$otc=$_POST['otc'];
$st=$_POST['st'];

$causa=$_POST['causa'];


$alergias=$_POST['alergias'];
$fre_card=$_POST['fre_card'];
$patologias=$_POST['patologias'];
$fre_resp=$_POST['fre_resp'];
$medicacion=$_POST['medicacion'];
$pres_arte=$_POST['pres_arte'];
$liq_alim=$_POST['liq_alim'];
$temp=$_POST['temp'];


$oxig=$_POST['oxig'];
$vent=$_POST['vent'];
$aspir=$_POST['aspir'];
$intub=$_POST['intub'];
$rccp=$_POST['rccp'];
$desfi=$_POST['desfi'];
$monit=$_POST['monit'];
$vend=$_POST['vend'];
$inmov=$_POST['inmov'];
$collar=$_POST['collar'];
$apoy_psi=$_POST['apoy_psi'];
$asepsia=$_POST['asepsia'];
$liquidos=$_POST['liquidos'];
$otros_pro=$_POST['otros_pro'];
$medicacion_pro=$_POST['medicacion_pro'];


$desc_hall=$_POST['desc_hall'];
$diag=$_POST['diag'];
$op_amb=$_POST['op_amb'];
$nom_eps=$_POST['nom_eps'];
$trip_aux=$_POST['trip_aux'];
$est_ent=$_POST['est_ent'];
$num_amb=$_POST['num_amb'];
$cli_hos=$_POST['cli_hos'];
$medico=$_POST['medico'];

$act_reg="update tbl_ambulancia set via='$via', tramo='$tramo', calzada='$calzada', abcisa='$abcisa', h_ped='$h_ped', fechahorallegada='$h_llegada',
fechahoraatencion='$h_atencion', fechahorarecepcion='$h_rec', nom_us='$nom_inv', ced_us='$ced_inv', tel_us='$tel_inv', placa_veh='$placa_veh',
dir_us='$dir_res', aseguradora='$aseg', nom_acom='$nomb_acomp', tel_acom='$tel_acomp', enfer_gen='$enf_gen', victimas='$vict_danos', acc_tran='$acc_tran',
acc_trab='$acc_trab', lesion_agre='$lesion_agre', catastrofe='$castastrofe', acc_comun='$acc_comun', otros='$otros_cau',causa_ext='$causa', alergias='$alergias', patologias='$patologias',
medicacion_ant='$medicacion', liq_alim='$liq_alim', frec_card='$fre_card', frec_resp='$fre_resp', presion='$pres_arte', temp='$temp', oxig='$oxig',
aspiracion='$aspir', rccp='$rccp', monitoreo='$monit', inmov='$inmov', apoyo_psic='$apoy_psi', liquidos='$liquidos', medicacion_proc='$medicacion_pro',
ventilacion='$vent', intubacion='$intub', desfibrilacion='$desfi', vendaje='$vend', collar_cervical='$collar', asepsia='$asepsia',
otros_proc='$otros_pro', des_hallazgos='$desc_hall', diagnostico='$diag', oper_amb='$op_amb', aux_amb='$trip_aux', num_amb='$num_amb',
clinica_hosp='$cli_hos', mfs='$mfs', smc='$smc', srg='$srg', svpb='$svpb', febdm='$febdm', cnvn='$cnvn', stb='$stb', otc='$otc', st='$st',
nom_eps='$nom_eps', estado_ent='$est_ent', medico='$medico' where id_parte=$id_parte and id_ambulancia='$id_amb' ";


 $res= mysql_query($act_reg,$link);

?>
<meta HTTP-EQUIV="REFRESH" content="0; url=menu_insp.php">