<?php
session_start();
include 'funciones.php';
$link=Conectarse();

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

$act_reg= "update tbl_parte set ambulancia=1 where id_parte=$id_parte";
$resultado= mysql_query($act_reg,$link);

 $nuevo_reg="insert into tbl_ambulancia values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$h_ped."',
     '".$h_llegada."','".$h_atencion."','".$h_rec."','".$nom_inv."','".$ced_inv."','".$tel_inv."','".$placa_veh."','".$dir_res."','".$aseg."','".$nomb_acomp."',
     '".$tel_acomp."','".$enf_gen."','".$vict_danos."','".$acc_tran."','".$acc_trab."','".$lesion_agre."','".$castastrofe."','".$acc_comun."',
     '".$otros_cau."','".$causa."','".$alergias."','".$patologias."','".$medicacion."','".$liq_alim."','".$fre_card."','".$fre_resp."',
     '".$pres_arte."','".$temp."','".$oxig."','".$aspir."','".$rccp."','".$monit."','".$inmov."',
     '".$apoy_psi."','".$liquidos."','".$medicacion_pro."','".$vent."','".$intub."','".$desfi."','".$vend."',
     '".$collar."','".$asepsia."','".$otros_pro."','".$desc_hall."','".$diag."','".$op_amb."','".$trip_aux."',
     '".$num_amb."','".$cli_hos."','".$mfs."','".$smc."','".$srg."','".$svpb."','".$febdm."',
     '".$cnvn."','".$stb."','".$otc."','".$st."','".$nom_eps."','".$est_ent."','".$medico."')";
 $res= mysql_query($nuevo_reg,$link);

echo $nuevo_reg;
?>
<meta HTTP-EQUIV="REFRESH" content="10; url=menu_insp.php">