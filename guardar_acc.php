<?php
session_start();
include 'funciones.php';
include 'mail/enviar.php';
$link=Conectarse();
$ced=$_SESSION["ced"];

$fechahora=$_POST['fecha'];
$via=$_POST['via'];
$tramo=$_POST['tramo'];
$calzada=$_POST['calzada'];
$abcisa=$_POST['abcisa'];
$punto=$_POST['punto'];
$antendido=$_POST['atendido'];
$motivo_atencion=$_POST['motivo_atencion'];
$nom_via=$_POST['nom_via'];
$nom_tramo=$_POST['nom_tramo'];
$fec_pro=$_POST['fec_pro'];
$fec_con=$_POST['fec_con'];
$fecha_ini=$_POST['fec_ini'];
$fecha_fin=$_POST['fec_fin'];
$car_obs=$_POST['c_obs'];
$fuego=$_POST['fuego'];
$dano_obra=$_POST['dano_via'];
$atrop=$_POST['atrop'];
$cai_ocup=$_POST['cai_ocu'];
$ch_semo=$_POST['ch_sem'];
$ch_obj=$_POST['ch_obj'];
$ch_veh=$_POST['choque_veh'];
$ch_metro=$_POST['ch_tren'];
$volca=$_POST['volc'];
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
$fotos=0;

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


$cons="select * from tbl_parte where id_parte=$id_parte";
 $query= mysql_query($cons,$link);
 $vect_in = mysql_fetch_assoc($query);

 if($vect_in['motivo_parte']==''){

 $crea_parte="update tbl_parte set motivo_parte='Accidente', usuario='".$ced."'  where id_parte=$id_parte ";
 $result= mysql_query($crea_parte,$link);
 }


echo $nuevo_regi="insert into tbl_parte values ('','','".$fechahora."','Accidente','0','0','0','".$ced."', '".$antendido."', '".$motivo_atencion."')";
$resultado1= mysql_query($nuevo_regi,$link);

//Se obtiene el numero de parte
$parte = mysql_insert_id();

$consulta="SELECT * FROM tbl_parte where fechahora='$fechahora'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$id_parte=$row["id_parte"];

$_SESSION[id_parte]=$id_parte;

 $nuevo_reg="insert into tbl_accidente values ('','".$id_parte."','".$via."','".$tramo."','".$calzada."','".$abcisa."','".$punto."','".$nom_tramo."','".$fec_pro."','".$fec_con."','".$fecha_ini."','".$fecha_fin."','".$car_obs."','".$fuego."','".$dano_obra."','".$ch_veh."','".$atrop."','".$cai_ocup."','".$ch_metro."','".$ch_obj."','".$volca."','".$ch_semo."','".$otros_acc."','".$amb."','".$grua."','".$agen_tran."','".$sena."','".$pol_nal."','".$bomberos."','".$def_civil."','".$fiscalia."','".$dir_oper."','".$pol_car."','".$insp_vial."','".$pol_tran."','".$mante."','".$res_oper."','".$otros_serv."','".$ilum."','".$rod."','".$rod_lim."','".$trafico."','".$dano_aut."',
     '".$embri."','".$exc_vel."','".$fallas."','".$falta_pre."','".$no_dis."','".$obs_via."','".$sup_hum."',
     '".$ade_proh."','".$imp_con."','".$mal_est."','".$imp_peat."','".$contravia."','".$sem_via."','".$obras_via."',
     '".$huecos_via."','".$hip_otros."','".$desc."','".$fotos."')";
 $res= mysql_query($nuevo_reg,$link);

 /*
 * Establecer parametros para enviar el correo
 */
$usuarios = array("maribel.pena@hatovial.com", "monica.ochoa@hatovial.com", "juan.gonzalez@hatovial.com");                                //Se definen los usuarios a los que se enviara los correos
// $usuarios = array("john.cano@hatovial.com");        //Se definen los usuarios a los que se enviara los correos
    
//Se consulta el inspector
$consultar_inspector =
"SELECT
    CONCAT(tbl_usuarios.us_nombre, ' ',tbl_usuarios.us_apellido) AS inspector
FROM tbl_usuarios
    INNER JOIN tbl_parte ON tbl_parte.usuario = tbl_usuarios.id_usuario
WHERE
tbl_parte.id_parte = ".$parte;

$inspector = mysql_query($consultar_inspector, $link);
$insp = mysql_fetch_array($inspector);

$plantilla = "reportes/plantilla_email.html";       //Se envia la ruta de la plantilla para el correo

//Se preparan los datos a enviar
$mensaje = utf8_decode("Se ha creado un accidente con el número de parte ".$parte.":<br/><br/>Inspector: ".$insp["inspector"]."<br/>Descripción: ".$desc);
$asunto = "Creación de parte por accidente";

//Se ejecuta la funcion que envia el email
enviar($asunto, $mensaje, $plantilla, $usuarios);
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=involucrados.php">
