<?php
//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();

// Sesión
$log=$_SESSION["log"];

// Si no ha iniciado sesión
if ($log==0){
    // Se destruye y redirecciona
    session_destroy();
    ?>
    <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
    <?php
}

// Variable de parte
$id_parte=$_SESSION["id_parte"];
?>
<html>
    <head>
        <?php include 'funciones.php';
        $link=Conectarse();
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Registro de Inspectores</title>
        
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		
        <script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>		
		<script src="js/jquery-1.7.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#tramo").change(function () {
					$("#tramo option:selected").each(function () {
						elegido=$(this).val();
						//$("#punto").val("");
						//$("#punto").attr("title","");
						$("#nom_tramo").val("");
						$("#via").val("");
						$("#abscisa").html("");
						if(elegido=="Seleccione"){
							return false;
						}
						$.post("tramo.php", { elegido: elegido }, function(data){
							$("#abscisa").html("");
							array_datos = data.split('|');
							longitud = array_datos.length;
							$("#nom_tramo").val(array_datos[0]);
							$("#via").val(array_datos[1]);
						});
					});
				});
			});
		</script>

		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>

    <body>
        <?php
        // Consultas SQL para mostrar la información ya antes guardada y modificarla.
        $consulta="SELECT * FROM tbl_accidente LEFT JOIN tbl_parte ON tbl_accidente.id_parte = tbl_parte.id_parte where tbl_parte.id_parte = '$id_parte'";
        $resul= mysql_query($consulta,$link);
        $row = mysql_fetch_array($resul);

        $consulta2="SELECT * FROM tbl_involucrados where id_parte='$id_parte'";
        $resul2= mysql_query($consulta2,$link);
        $row2 = mysql_fetch_array($resul2);

        $consulta3="SELECT * FROM tbl_victimas where id_parte='$id_parte'";
        $resul3= mysql_query($consulta3,$link);
        $row3 = mysql_fetch_array($resul3);
        ?>

        <div id="contenedor_insp">
            <form action="mod_accidente.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
                <div id="contenedor-logo">
                    <div class="logo"></div>
                </div>

                <div class="encabezado">
                    <div class="global">
                        Consecutivo
                        <div class="campos">
                            <!-- Se imprime el id_parte en el formulario -->
                            <?php echo $id_parte;?>
                            <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $id_parte;?>">
                        </div>
                    </div>

                    <div class="global">
                        <div class="titulos">
                            <b>Tramo</b>
                        </div>
                        <div class="campos">
                            <select id="tramo" name="tramo" class="sen-class" >
                                <optgroup label="Seleccione">
                                    <option value="<?php echo $row["tramo"];?>">Tramo <?php echo $row["tramo"];?></option>
                                    <option value=""></option>
                                    <option value="0">Tramo 0</option>
                                    <option value="1">Tramo 1</option>
                                    <option value="4">Tramo 4</option>
                                    <option value="5">Tramo 5</option>
                                    <option value="6">Tramo 6</option>
                                    <option value="8">Tramo 8</option>
                                    <option value="9">Tramo 9</option>
                                    <option value="15">Tramo 15</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="global">
                        <div class="titulos">
                            <b>Nombre</b>
                        </div>
                        <div class="campos">
                            <input type="text" id="nom_tramo" name="nom_tramo" class="sen-class" value="<?php echo $row["nombre_tramo"]; ?>"  />
                        </div>
                    </div>

                    <div class="global">
                        <div class="titulos">
                            <b>Via</b>
                        </div>
                        <div class="campos">
                            <input type="text" class="sen-class" readonly="readonly" id="via" value="<?php echo $row["via"];?>" name="via">
                        </div>
                    </div>
                    
                    <div class="global">
                        <div class="titulos">
                            <b>Abscisa</b>
                        </div>
                        <div class="campos">
                            <input type="text" id="abcisa" name="abcisa" class="sen-class" value="<?php echo $row["abcisa"]; ?>" >
                        </div>
                    </div>

                    <div class="global">
                        <div class="titulos">
                            <b>Calzada</b>
                        </div>
                        <div class="campos">
                            <select id="calzada" name="calzada" class="sen-class" >
                                <optgroup label="Seleccione">
                                    <option value="<?php echo $row["calzada"];?>"><?php echo $row["calzada"];?></option>
                                    <option value="W">W</option>
                                    <option value="E">E</option>
                                    <option value="N/A">N/A</option>
                                    <option value="W/E">W/E</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="sep"></div>

                <div class="ubicacion">
                    <div class="global1">
                        <div class="titulos1">Punto de Referencia:</div>
                        <div class="campos1"><input type="text" id="punto" name="punto" class="sen-class" value="<?php echo $row["punto_referencia"]; ?>"  /></div>
                    </div>
                    <div class="global1">
                        <div>¿Fue atendido?
                            <input type="radio" name="atendido" value="1" <?php if($row["atendido"] == 1){echo "checked";} ?> />Si
                            <input type="radio" name="atendido" value="0" <?php if($row["atendido"] == 0){echo "checked";} ?>/>No
                        </div>

                        <div>Motivo de la no atención
                            <select id="motivo_atencion" name="motivo_atencion" class="sen-class">
                                <option value=""></option>
                                
                                <?php
                                $consulta = "select * from tbl_motivo_inasistencia order by nombre ASC";
                                $resultado = mysql_query($consulta,$link);
                                while($motivo = mysql_fetch_assoc($resultado)){
                                    echo "<option value='".$motivo["id"]."'>".$motivo["nombre"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <script>
                            $(document).ready(function(){
                                // Se pone por defecto el valor que traiga
                                $("#motivo_atencion").val("<?php echo $row['id_motivo_atencion']; ?>")
                            }) 
                        </script>
                    </div>
                </div>

                <div class="sep"></div>

                <div class="contenedor2">
                    <div class="datos_acc">
                        <div class="titulo_datos"> <b>DATOS DEL ACCIDENTE</b></div>
                        <div class="texto_datos">Formato de las fechas:</div>
                        <div class="campo_datos">(YYYY-MM-DD HH:MM)</div>
                        <div class="texto_datos">Fecha y hora se produjo:</div>
                        <div class="campo_datos"><input type="text" id="fec_pro" name="fec_pro" class="sen-class1" value="<?php echo $row["fec_pro"]; ?>" ><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="texto_datos">Fecha y hora conocimiento:</div>
                        <div class="campo_datos"><input type="text" id="fec_con" name="fec_con" class="sen-class1" value="<?php echo $row["fec_con"]; ?>" ><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="texto_datos">Fecha y hora de atención:</div>
                        <div class="campo_datos"><input type="text" id="fec_ini" name="fec_ini" class="sen-class1" value="<?php echo $row["fechahora_ini"]; ?>" ><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_3" name="cal_3"></div>
                        <div class="texto_datos">Fecha y hora de termino:</div>
                        <div class="campo_datos"><input type="text" id="fec_fin" name="fec_fin" class="sen-class1" value="<?php echo $row["fechahora_fin"]; ?>" ><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_4" name="cal_4"></div>

                        <script type="text/javascript">//<![CDATA[
                            var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "fec_pro", "%Y-%m-%d %H:%M:%S");
						  cal.manageFields("cal_2", "fec_con", "%Y-%m-%d %H:%M:%S");
						  cal.manageFields("cal_3", "fec_ini", "%Y-%m-%d %H:%M:%S");
						  cal.manageFields("cal_4", "fec_fin", "%Y-%m-%d %H:%M:%S");

					//]]></script>
					
                    <div class="texto_datos">No. carriles obstruidos:</div>
                    <div class="campo_datos"><input type="text" id="c_obs" name="c_obs" class="sen-class2" value="<?php echo $row["carriles_obs"]; ?>" ></div>
                    <div class="texto_datos">Se produjo fuego?:</div>
                    <div class="campo_datos"><select id="fuego" name="fuego" class="sen-class2"  >
                    <optgroup label="Seleccione">
                    <option value="<?php echo $row["fuego"]; ?>"><?php echo $row["fuego"]; ?></option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                    </optgroup>
                    </select></div>
                    <div class="texto_datos">Daños en la obra?:</div>
                    <div class="campo_datos"><select id="dano_via" name="dano_via" class="sen-class2" >
                    <optgroup label="Seleccione">
                    <option value="<?php echo $row["danos_obra"]; ?>"><?php echo $row["danos_obra"]; ?></option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                    </optgroup>
                    </select></div>


                </div>

                    <div class="tipo_acc">
                        <div class="titulo_acc"><b>TIPO DE ACCIDENTE</b></div>
                        <!--SE VERIFICA SI LOS CAMPOS TIENEN UNA X PARA SELECCIONAR, DE LO CONTRARIO CON SE CHEQUEA -->
                       <div class="bloque21">
                        <div class="texto_tipo">Choque contra vehiculo:</div>
                        <?php if($row["ch_contra_veh"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["ch_contra_veh"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque contra objeto fijo:</div>
                        <?php if($row["ch_contra_obj"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["ch_contra_obj"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" value="X" class="checks1"  ></div>
                        <?php } ?>
                        <div class="texto_tipo">Atropello:</div>
                        <?php if($row["atropello"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["atropello"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Volcamiento:</div>
                        <?php if($row["volcamiento"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="volc" name="volc" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["volcamiento"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="volc" name="volc" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Caida del ocupante:</div>
                        <?php if($row["caida_del_ocu"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="cai_ocu" name="cai_ocu" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["caida_del_ocu"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="cai_ocu" name="cai_ocu" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque con semoviente:</div>
                        <?php if($row["ch_contra_sem"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_sem" name="ch_sem" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["ch_contra_sem"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_sem" name="ch_sem" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque con metro o tren:</div>
                        <?php if($row["ch_contra_metro"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_tren" name="ch_tren" value="X" class="checks1" checked></div>
                        <?php } ?>
                        <?php if($row["ch_contra_metro"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_tren" name="ch_tren" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Otros, Cual?:</div>
                        <div class="otro_tipo"><input type="text" id="otro_tipo" name="otro_acc" class="sen-class1" value="<?php echo $row["otros_acc"]; ?>" ></div>

                    </div>
                    </div>

                </div>
                <div class="sep"></div>
                <?php $contt1==0; ?>
                <div  style="height:<?php contt1 ?>px; width:900px; margin: 0 auto; padding: 0; float: left; text-align: center; background: #efecff;">
                <div class="titulo_serv"><b>INVOLUCRADOS</b></div>
                    <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="900" >
                        <TR align="center"><TD>&nbsp;<b>NOMBRE</b></TD><TD>&nbsp;<b>CEDULA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>TELEFONO</b>&nbsp;</TD><TD>&nbsp;<b>CELULAR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>PLACA</b>&nbsp;</TD><TD>&nbsp;<b>COLOR</b>&nbsp;</TD>
                        <TD>&nbsp;<b>MARCA</b>&nbsp;</TD><TD>&nbsp;<b>SERVICIO</b>&nbsp;</TD>
                        <TD>&nbsp;<b>TIPO</b>&nbsp;</TD></TR>
                    <?php
                    // Consulta a la tabla involucrados, para mostrarlos en la tabla
                    $consul="select * from tbl_involucrados where id_parte='$id_parte'";
                    $result=mysql_query($consul,$link);

                    while($vect_ins = mysql_fetch_assoc($result)) {
                        $contt1== $contt1+50;
                        // Se imprime la tabla con los datos resultantes a la consulta en la variable $consul
                    printf("<tr width=900px><td>&nbsp;%s</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td></tr>",
                    $vect_ins["nombre"],$vect_ins["cedula"],$vect_ins["telefono"],$vect_ins["celular"],$vect_ins["placa_veh"],$vect_ins["color_veh"],$vect_ins["marca_veh"],$vect_ins["servicio_veh"],$vect_ins["tipo_veh"],'<input type="radio" id='.$vect_ins["cedula"]);
                          }

                    ?>
                        </TABLE>
                    </div>
                <div class="sep"></div>
                <?php $contt==0; ?>
                <div  style="height:<?php contt ?>px; width:900px; margin: 0 auto; padding: 0; float: left; text-align: center; background: #efecff;">
                    <div class="titulo_serv"><b>VICTIMAS</b></div>
                    <TABLE BORDER=1 CELLSPACING=1 CELLPADDING=1 width="800" align="center" >
                        <TR align="center"><TD>&nbsp;<b>NOMBRE</b></TD><TD>&nbsp;<b>CEDULA</b>&nbsp;</TD>
                        <TD>&nbsp;<b>ESTADO</b>&nbsp;</TD><TD>&nbsp;<b>TIPO DE VICTIMA</b>&nbsp;</TD>
                        </TR>
                    <?php
                    // Consulta a la tabla victimas, para mostrarlos en la tabla
                    $consul="select * from tbl_victimas where id_parte=$id_parte";
                     $result=mysql_query($consul,$link);

                    while($vect_ins = mysql_fetch_array($result)) {
                    $contt== $contt+50;

                    printf("<tr width=800><td>&nbsp;%s</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td></tr>",
                    $vect_ins["nombre_vic"],$vect_ins["cedula"],$vect_ins["estado_vic"],$vect_ins["relacion_vic"],'<input type="radio" id='.$vect_ins["cedula"]);

                     }
                    ?>
                        </TABLE>
                    </div>


                <div class="sep"></div>
                <div class="contenedor3">
                    <div class="titulo_serv"><b>TIPO DE SERVICIO PRESENTE PARA LA ATENCION</b></div>
                    <div class="bloque2">
                        <div class="texto_serv">Ambulancia:</div>
                        <?php if($row["ambulancia"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="amb" name="amb" value="X" class="checks1" checked></div>
                        <?php } ?>
                        <?php if($row["ambulancia"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="amb" name="amb" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Bomberos:</div>
                        <?php if($row["bomberos"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="bom" name="bom" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["bomberos"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="bom" name="bom" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Inspector Vial:</div>
                        <?php if($row["insp_vial"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["insp_vial"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Grua Concesión:</div>
                        <?php if($row["grua_con"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="grua" name="grua" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["grua_con"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="grua" name="grua" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Defensa Civil:</div>
                        <?php if($row["defensa_civil"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" value="X" class="checks1" checked></div>
                        <?php } ?>
                        <?php if($row["defensa_civil"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_serv">Policia Transito:</div>
                        <?php if($row["policia_trans"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" value="X" class="checks1" checked></div>
                        <?php } ?>
                        <?php if($row["policia_trans"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" value="X" class="checks1"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Agentes de Transito:</div>
                        <?php if($row["agentes_trans"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["agentes_trans"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Fiscalia:</div>
                        <?php if($row["fiscalia"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["fiscalia"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Mantenimiento:</div>
                        <?php if($row["mantenimiento"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="mant" name="mant" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["mantenimiento"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="mant" name="mant" value="X" class="checks1"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Señalización:</div>
                        <?php if($row["senalizacion"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="sena" name="sena" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["senalizacion"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="sena" name="sena" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Director Operativo:</div>
                        <?php if($row["director_oper"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["director_oper"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Residente Operativo:</div>
                        <?php if($row["residente_ope"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["residente_ope"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Policia Nacional:</div>
                        <?php if($row["policia_nal"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["policia_nal"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv">Policia de carreteras:</div>
                        <?php if($row["policia_carreteras"]=='X'){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_car" name="pol_car" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["policia_carreteras"]==''){ ?>
                        <div class="check_serv"><input type="checkbox" id="pol_car" name="pol_car" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_serv">Otros, Cual?:</div>
                        <div class="otro_serv"><input type="text" id="serv_otros" name="serv_otros"  class="sen-class1" value="<?php echo $row["otros_serv"]; ?>"></div>

                    </div>

                </div>
                <div class="sep"></div>
                <div class="contenedor4">
                <div class="titulo_cond"><b>CONDICIONES</b></div>
                <div class="bloque3">
                <div class="global_cond">
                <div class="texto_cond">Iluminacion</div>
                <div class="campos_cond"><select id="ilum_cond" name="ilum_cond" class="sen-class" >
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["iluminacion"]; ?>"><?php echo $row["iluminacion"]; ?></option>
                            <option value="Natural">Natural</option>
                            <option value="Artificial">Artificial</option>
                            <option value="Sin_iluminacion">Sin iluminacion</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Rodadura</div>
                <div class="campos_cond"><select id="rod_cond" name="rod_cond" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["rodadura"]; ?>"><?php echo $row["rodadura"]; ?></option>
                            <option value="Seca">Seca</option>
                            <option value="Humedo">Humedo</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Rodadura Limpieza</div>
                <div class="campos_cond"><select id="rodlim_cond" name="rodlim_cond" class="sen-class" >
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["roda_lim"]; ?>"><?php echo $row["roda_lim"]; ?></option>
                            <option value="Limpia">Limpia</option>
                            <option value="Sucia_arena">Sucia arena</option>
                            <option value="Sucia_gasolina">Sucia gasolina</option>
                            <option value="Sucia_acpm">Sucia ACPM</option>
                            <option value="Sucia_aceite">Sucia aceite</option>
                            <option value="Sucia_vidrios">Sucia vidrios</option>
                            <option value="Sucia_lodo">Sucia lodo</option>
                            <option value="Sucia_otros">Sucia otros</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Trafico</div>
                <div class="campos_cond"><select id="traf_cond" name="traf_cond" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["trafico"]; ?>"><?php echo $row["trafico"]; ?></option>
                            <option value="Nulo">Nulo</option>
                            <option value="Bajo">Bajo</option>
                            <option value="Medio">Medio</option>
                            <option value="Alto">Alto</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Daños a la vía</div>
                <div class="campos_cond"><select id="danos_cond" name="danos_cond" class="sen-class" >
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["danos_auto"]; ?>"><?php echo $row["danos_auto"]; ?></option>
                            <option value="Barrera_nes_yersey">Barrera New Yersey</option>
                            <option value="Barrera_peaje">Barrera Peaje</option>
                            <option value="Cabina_peaje">Cabina Peaje</option>
                            <option value="Defensa_seguridad">Defensa de seguridad</option>
                            <option value="Señal">Señal</option>
                            <option value="Columna_iluminacion">Columna iluminacion</option>
                            <option value="Ninguno">Ninguno</option>
                            <option value="Otros">Otros</option>
                            </optgroup>
                            </select></div>
                </div>
                </div>
                </div>

                <div class="sep"></div>
                <div class="contenedor5">
                <div class="titulo_cond"><b>HIPOTESIS</b></div>
               <div class="bloque2">
                   <div class="texto_serv1">Embriaguez:</div>
                        <?php if($row["embri"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="embri" name="embri" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["embri"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="embri" name="embri" value="X" class="checks1" ></div>
                        <?php } ?>

                        <div class="texto_serv1">Exceso de Velocidad:</div>
                        <?php if($row["exc_vel"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="exc_vel" name="exc_vel" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["exc_vel"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="exc_vel" name="exc_vel" value="X" class="checks1" ></div>
                        <?php } ?>

                        <div class="texto_serv1">Fallas Mecanicas:</div>
                        <?php if($row["fallas"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="fallas" name="fallas" value="X" class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["fallas"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="fallas" name="fallas" value="X" class="checks1" ></div>
                        <?php } ?>
               </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Falta de Precaución:</div>
                        <?php if($row["falta_pre"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="falta_pre" name="falta_pre" value="X" checked class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["falta_pre"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="falta_pre" name="falta_pre" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv1">No conservar la distancia:</div>
                        <?php if($row["no_dis"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="no_dis" name="no_dis" value="X" checked class="checks1"></div>
                        <?php } ?>
                        <?php if($row["no_dis"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="no_dis" name="no_dis" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv1">Obstaculo en la vía:</div>
                        <?php if($row["obs_via"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="obs_via" name="obs_via" value="X" checked class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["obs_via"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="obs_via" name="obs_via" value="X" class="checks1"></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Superficie Húmeda:</div>
                        <?php if($row["sup_hum"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="sup_hum" name="sup_hum" value="X" checked class="checks1"></div>
                        <?php } ?>
                        <?php if($row["sup_hum"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="sup_hum" name="sup_hum" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv1">Adelantar sitio prohibido:</div>
                        <?php if($row["ade_proh"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="ade_proh" name="ade_proh" value="X" checked class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["ade_proh"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="ade_proh" name="ade_proh" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_serv1">Imprudencia conductor:</div>
                        <?php if($row["imp_con"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="imp_con" name="imp_con" value="X" checked class="checks1"></div>
                        <?php } ?>
                        <?php if($row["imp_con"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="imp_con" name="imp_con" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Vehículo mal estacionado:</div>
                        <?php if($row["mal_est"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="mal_est" name="mal_est" value="X" checked class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["mal_est"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="mal_est" name="mal_est" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv1">Obras en la vía:</div>
                        <?php if($row["obras_via"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="obras_via" name="obras_via" value="X" checked class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["obras_via"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="obras_via" name="obras_via" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_serv1">Imprudencia del peaton:</div>
                        <?php if($row["imp_peat"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="imp_peat" name="imp_peat" value="X" checked class="checks1"></div>
                        <?php } ?>
                        <?php if($row["imp_peat"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="imp_peat" name="imp_peat" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Vehiluco en contravia:</div>
                        <?php if($row["contravia"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="contravia" checked name="contravia" value="X" class="checks1" ></div>
                        <?php } ?>
                        <?php if($row["contravia"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="contravia" name="contravia" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_serv1">Semoviente en la vía:</div>
                        <?php if($row["sem_via"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="sem_via" name="sem_via" value="X" checked class="checks1"></div>
                        <?php } ?>
                        <?php if($row["sem_via"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="sem_via" name="sem_via" value="X" class="checks1"></div>
                        <?php } ?>
                        <div class="texto_serv1">Huecos en la vía:</div>
                        <?php if($row["huecos_via"]=='X'){ ?>
                        <div class="check_serv1"><input type="checkbox" id="huecos_via" checked name="huecos_via" value="X" class="checks1"></div>
                        <?php } ?>
                        <?php if($row["huecos_via"]==''){ ?>
                        <div class="check_serv1"><input type="checkbox" id="huecos_via" name="huecos_via" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                <div class="bloque2">
                        <div class="texto_serv1">Otros, Cual?:</div>
                        <div class="otro_serv1"><input type="text" id="hip_otros" name="hip_otros" class="sen-class1"  value="<?php echo $row['hip_otros'] ?>"></div>
                    </div>

                </div>
                <div class="sep"></div>
                <div class="contenedor5">
                    <div class="global_obs">
                    <div class="titulos_obs"><b>DESCRIPCION DE LOS HECHOS</b></div>
                    <div ><textarea id="desc_hechos" name="desc_hechos" class="textarea_obs" ><?php echo $row["descripcion"]; ?></textarea></div>
                    </div>
                    <div class="insp_botonera">
                    <input type="submit" id="guardar" name="guardar" value="Guardar" class="botones">
                    <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="botones" onclick="location.href='menu_insp.php'">

                </div>
                </div>

                </form>
                 </div>




    </body>
</html>
