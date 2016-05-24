<?php
//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
?>
<meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php
}
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
        <script type="text/javascript" src="js/jquery-1.7.min.js"></script>
    </head>
    <body>
    <?php
        //SE HACE CONSULTA LAS TABLAS DE ACCIDENTE, INVOLUCRADOS  Y VICTIMAS PARA MOSTRAR EN EL FORMULARIO
        $consulta="SELECT * FROM tbl_accidente where id_parte='$id_parte'";
        $resul= mysql_query($consulta,$link);
        $row = mysql_fetch_array($resul);

            $consulta="SELECT * FROM tbl_parte where id_parte='$id_parte'";
        $resul_parte= mysql_query($consulta,$link);
        $row_parte = mysql_fetch_array($resul_parte);

            $consulta="SELECT * FROM tbl_usuarios where id_usuario='".$row_parte['usuario']."'";
        $resul_usuario= mysql_query($consulta,$link);
        $row_usuario = mysql_fetch_array($resul_usuario);

        $consulta2="SELECT * FROM tbl_involucrados where id_parte='$id_parte'";
        $resul2= mysql_query($consulta2,$link);
        $row2 = mysql_fetch_array($resul2);

        $consulta3="SELECT * FROM tbl_victimas where id_parte='$id_parte'";
        $resul3= mysql_query($consulta3,$link);
        $row3 = mysql_fetch_array($resul3);
    ?>
    <div id="contenedor_insp">
        <form action="guardar_acc.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
                <div class="logo"></div>
                <input type="button" id="atras"  value="Visualizar fotos" name="atras" onclick="location.href='ver_fotos.php'" class="botones"/>
                <input type="button" id="imprimir"  value="Imprimir Planilla" name="imprimir" class="botones"/>
            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                    <?php
                        echo $id_parte;
                    ?>
                    </div>
                </div>
                <!-- <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <input type="text" class="sen-class" readonly="readonly" id="via" name="via" value="<?php //echo $row["via"];?>">
                    </div>
                </div> -->
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["tramo"];?></option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>Calzada</b>
                    </div>
                    <div class="campos">
                        <select id="calzada" name="calzada" class="sen-class" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["calzada"];?></option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="global">
                    <div class="titulos">
                        <b>Abscisa</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="abcisa" name="abcisa" class="sen-class" value="<?php echo $row["abcisa"]; ?>" disabled="disabled">
                    </div>
                </div>

                <div class="global">
                    <div class="titulos">
                        <div>¿Fue atendido?
                            <input type="radio" name="atendido" value="1" <?php if($row_parte["atendido"] == 1){echo "checked";} ?>  disabled/>Si
                            <input type="radio" name="atendido" value="0" <?php if($row_parte["atendido"] == 0){echo "checked";} ?> disabled/>No
                        </div>
                    </div>
                    <div class="campos">
                        <div>
                            <select id="motivo_atencion" name="motivo_atencion" class="sen-class" disabled>
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
                                $("#motivo_atencion").val("<?php echo $row_parte['id_motivo_atencion']; ?>")
                            }) 
                        </script>
                    </div>
                </div>
            </div>
            <div class="sep"></div>
            <div class="ubicacion">
                <div class="global1">
                    <div class="titulos1">Punto de Referencia:</div>
                    <div class="campos1"><input type="text" id="punto" name="punto" class="sen-class" value="<?php echo $row["punto_referencia"]; ?>" disabled="disabled" /></div>
                </div>
                <div class="global1">
                    <div class="titulos1">Nombre tramo:</div>
                    <div class="campos1"><input type="text" id="nom_tramo" name="nom_tramo" class="sen-class" value="<?php echo $row["nombre_tramo"]; ?>" disabled="disabled" /></div>
                </div>
            </div>
            <div class="sep"></div>
            <div class="contenedor2">
                <div class="datos_acc">
                    <div class="titulo_datos"> <b>DATOS DEL ACCIDENTE</b></div>
                    <div class="texto_datos">Formato de las fechas:</div>
                    <div class="campo_datos">(YYYY-MM-DD HH:MM)</div>
                    <div class="texto_datos">Fecha y hora se produjo:</div>
                    <div class="campo_datos"><input type="text" id="fec_fin" name="fec_pro" class="sen-class1" value="<?php echo $row["fec_pro"]; ?>" disabled="disabled"></div>
                    <div class="texto_datos">Fecha y hora conocimiento:</div>
                    <div class="campo_datos"><input type="text" id="fec_fin" name="fec_con" class="sen-class1" value="<?php echo $row["fec_con"]; ?>" disabled="disabled"></div>
                    <div class="texto_datos">Fecha y hora de atención:</div>
                    <div class="campo_datos"><input type="text" id="fec_ini" name="fec_ini" class="sen-class1" value="<?php echo $row["fechahora_ini"]; ?>" disabled="disabled"></div>
                    <div class="texto_datos">Fecha y hora de termino:</div>
                    <div class="campo_datos"><input type="text" id="fec_fin" name="fec_fin" class="sen-class1" value="<?php echo $row["fechahora_fin"]; ?>" disabled="disabled"></div>
                    <div class="texto_datos">No. carriles obstruidos:</div>
                    <div class="campo_datos"><input type="text" id="c_obs" name="c_obs" class="sen-class2" value="<?php echo $row["carriles_obs"]; ?>" disabled="disabled"></div>
                    <div class="texto_datos">Se produjo fuego?:</div>
                    <div class="campo_datos">
                        <select id="fuego" name="fuego" class="sen-class2" disabled="disabled" >
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["fuego"]; ?></option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="texto_datos">Daños en la obra?:</div>
                    <div class="campo_datos">
                        <select id="dano_via" name="dano_via" class="sen-class2" disabled="disabled">
                            <optgroup label="Seleccione">
                                <option value=""><?php echo $row["danos_obra"]; ?></option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="tipo_acc">
                    <div class="titulo_acc"><b>TIPO DE ACCIDENTE</b></div>
                    <!-- VERIFICAMOS SI LOS CAMPOS TIENEN UNA "X" LOS CHEQUEAMOS DE LOS CONTRARIO NO SE CHEQUEAN -->
                    <div class="bloque21">
                        <div class="texto_tipo">Choque contra vehiculo:</div>
                        <?php if($row["ch_contra_veh"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["ch_contra_veh"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque contra objeto fijo:</div>
                        <?php if($row["ch_contra_obj"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["ch_contra_obj"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" class="checks1" disabled="disabled" ></div>
                        <?php } ?>
                        <div class="texto_tipo">Atropello:</div>
                        <?php if($row["atropello"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["atropello"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Volcamiento:</div>
                        <?php if($row["volcamiento"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="volc" name="volc" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["volcamiento"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="volc" name="volc" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Caida del ocupante:</div>
                        <?php if($row["caida_del_ocu"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="cai_ocu" name="cai_ocu" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["caida_del_ocu"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="cai_ocu" name="cai_ocu" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque con semoviente:</div>
                        <?php if($row["ch_contra_sem"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_sem" name="ch_sem" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["ch_contra_sem"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_sem" name="ch_sem" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Choque con metro o tren:</div>
                        <?php if($row["ch_contra_metro"]=='X'){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_tren" name="ch_tren" class="checks1" checked disabled="disabled"></div>
                        <?php } ?>
                        <?php if($row["ch_contra_metro"]==''){ ?>
                        <div class="check_tipo"><input type="checkbox" id="ch_tren" name="ch_tren" class="checks1" disabled="disabled"></div>
                        <?php } ?>
                        <div class="texto_tipo">Otros, Cual?:</div>
                        <div class="otro_tipo"><input type="text" id="otro_tipo" name="otro_acc" class="sen-class1" value="<?php echo $row["otros_acc"]; ?>" disabled="disabled"></div>
                    </div>
                </div>
            </div>
            <div class="sep"></div>
            <div style="width:900px; margin: 0 auto; padding: 0; float: left; text-align: center; background: #efecff;">
                <div class="titulo_serv"><b>INVOLUCRADOS</b></div>
                <table border=1 cellspacing=1 cellpading=1 width="900" >
                    <tr align="center">
                        <td>&nbsp;<b>NOMBRE</b></td>
                        <td>&nbsp;<b>C&Eacute;DULA</b>&nbsp;</td>
                        <td>&nbsp;<b>TELEFONO</b>&nbsp;</td>
                        <td>&nbsp;<b>CELULAR</b>&nbsp;</td>
                        <td>&nbsp;<b>PLACA</b>&nbsp;</td>
                        <td>&nbsp;<b>COLOR</b>&nbsp;</td>
                        <td>&nbsp;<b>MARCA</b>&nbsp;</td>
                        <td>&nbsp;<b>SERVICIO</b>&nbsp;</td>
                        <td>&nbsp;<b>TIPO</b>&nbsp;</td>
                    </tr>
                    <?php
                    // SELECCIONAMOS LOS DATOS DE LA TABLA DE INVOLUCRADOS PARA MOSTRARLOS EN UNA TABLA HTML
                    $consul="select * from tbl_involucrados where id_parte='$id_parte'";
                    $result=mysql_query($consul,$link);

                    while($vect_ins = mysql_fetch_assoc($result)){
                        printf("
                            <tr width=900px>
                                <td>&nbsp;%s</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                            </tr>",
                            $vect_ins["nombre"],
                            $vect_ins["cedula"],
                            $vect_ins["telefono"],
                            $vect_ins["celular"],
                            $vect_ins["placa_veh"],
                            $vect_ins["color_veh"],
                            $vect_ins["marca_veh"],
                            $vect_ins["servicio_veh"],
                            $vect_ins["tipo_veh"],
                            '<input type="radio" id='.$vect_ins["cedula"]);
                    }
                    ?>
                </table>
            </div>
            <div class="sep"></div>
            <div  style="width:900px; margin: 0 auto; padding: 0; float: left; text-align: center; background: #efecff;">
                <div class="titulo_serv"><b>VICTIMAS</b></div>
                <table border=1 cellspacing=1 cellpadding=1 width="800" align="center" >
                    <tr align="center">
                        <td>&nbsp;<b>NOMBRE</b></td>
                        <td>&nbsp;<b>C&Eacute;DULA</b>&nbsp;</td>
                        <td>&nbsp;<b>ESTADO</b>&nbsp;</td>
                        <td>&nbsp;<b>TIPO DE V&Iacute;CTIMA</b>&nbsp;</td>
                    </tr>
                    <?php
                    // SELECCIONAMOS LOS DATOS DE LA TABLA VICTIMA PARA MOSTRARLOS EN UNA TRABLA HTML
                    $consul="select * from tbl_victimas where id_parte=$id_parte";
                    $result=mysql_query($consul,$link);

                    while($vect_ins = mysql_fetch_array($result)) {
                        printf("
                            <tr width=800>
                                <td>&nbsp;%s</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                                <td>&nbsp;%s&nbsp;</td>
                            </tr>",
                            $vect_ins["nombre_vic"],
                            $vect_ins["cedula"],
                            $vect_ins["estado_vic"],
                            $vect_ins["relacion_vic"],
                            '<input type="radio" id='.$vect_ins["cedula"]);
                    }
                    ?>
                </table>
            </div>
            <div class="sep"></div>
            <div class="contenedor3">
                <div class="titulo_serv"><b>TIPO DE SERVICIO PRESENTE PARA LA ATENCI&Oacute;N</b></div>
                <div class="bloque2">
                    <!-- VERIFICAMOS SI LOS CAMPOS TIENEN UNA "X" LOS CHEQUEAMOS DE LOS CONTRARIO NO SE CHEQUEAN -->
                    <div class="texto_serv">Ambulancia:</div>
                    <?php if($row["ambulancia"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="amb" name="amb" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["ambulancia"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="amb" name="amb" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Bomberos:</div>
                    <?php if($row["bomberos"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="bom" name="bom" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["bomberos"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="bom" name="bom" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Inspector Vial:</div>
                    <?php if($row["insp_vial"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["insp_vial"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv">Grua Concesión:</div>
                    <?php if($row["grua_con"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="grua" name="grua" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["grua_con"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="grua" name="grua" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Defensa Civil:</div>
                    <?php if($row["defensa_civil"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["defensa_civil"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Policia Transito:</div>
                    <?php if($row["policia_trans"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["policia_trans"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv">Agentes de Transito:</div>
                    <?php if($row["agentes_trans"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["agentes_trans"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Fiscalia:</div>
                    <?php if($row["fiscalia"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["fiscalia"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Mantenimiento:</div>
                    <?php if($row["mantenimiento"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="mant" name="mant" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["mantenimiento"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="mant" name="mant" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv">Señalización:</div>
                    <?php if($row["senalizacion"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="sena" name="sena" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["senalizacion"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="sena" name="sena" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Director Operativo:</div>
                    <?php if($row["director_ope"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["director_ope"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Residente Operativo:</div>
                    <?php if($row["residente_ope"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["residente_ope"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv">Policia Nacional:</div>
                    <?php if($row["policia_nal"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["policia_nal"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Policia de carreteras:</div>
                    <?php if($row["policia_carreteras"]=='X'){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_car" name="pol_car" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["policia_carreteras"]==''){ ?>
                    <div class="check_serv"><input type="checkbox" id="pol_car" name="pol_car" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv">Otros, Cual?:</div>
                    <div class="otro_serv"><input type="text" id="serv_otros" name="serv_otros" class="sen-class1" value="<?php echo $row["otros_serv"]; ?>" disabled="disabled"></div>
                </div>
            </div>
            <div class="sep"></div>
            <div class="contenedor4">
                <div class="titulo_cond"><b>CONDICIONES</b></div>
                <div class="bloque3">
                    <div class="global_cond">
                        <div class="texto_cond">Iluminacion</div>
                        <div class="campos_cond">
                            <select id="ilum_cond" name="ilum_cond" class="sen-class" disabled="disabled" >
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["iluminacion"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="global_cond">
                        <div class="texto_cond">Rodadura</div>
                        <div class="campos_cond">
                            <select id="rod_cond" name="rod_cond" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["rodadura"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="global_cond">
                        <div class="texto_cond">Rodadura Limpieza</div>
                        <div class="campos_cond">
                            <select id="rodlim_cond" name="rodlim_cond" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["roda_lim"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="global_cond">
                        <div class="texto_cond">Trafico</div>
                        <div class="campos_cond">
                            <select id="traf_cond" name="traf_cond" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["trafico"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="global_cond">
                        <div class="texto_cond">Daños a la vía</div>
                        <div class="campos_cond">
                            <select id="danos_cond" name="danos_cond" class="sen-class" disabled="disabled">
                                <optgroup label="Seleccione">
                                    <option value=""><?php echo $row["danos_auto"]; ?></option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sep"></div>
            <div class="contenedor5">
                <div class="titulo_cond"><b>HIP&Oacute;TESIS</b></div>
                <div class="bloque2">
                    <div class="texto_serv1">Embriaguez:</div>
                    <?php if($row["embri"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="embri" name="embri" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["embri"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="embri" name="embri" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Exceso de Velocidad:</div>
                    <?php if($row["exc_vel"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="exc_vel" name="exc_vel" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["exc_vel"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="exc_vel" name="exc_vel" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Fallas Mecanicas:</div>
                    <?php if($row["fallas"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="fallas" name="fallas" class="checks1" checked disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["fallas"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="fallas" name="fallas" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv1">Falta de Precaución:</div>
                    <?php if($row["falta_pre"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="falta_pre" name="falta_pre" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["falta_pre"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="falta_pre" name="falta_pre" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">No conservar la distancia:</div>
                    <?php if($row["no_dis"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="no_dis" name="no_dis" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["no_dis"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="no_dis" name="no_dis" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Obstaculo en la vía:</div>
                    <?php if($row["obs_via"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="obs_via" name="obs_via" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["obs_via"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="obs_via" name="obs_via" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv1">Superficie H&uacute;meda:</div>
                    <?php if($row["sup_hum"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="sup_hum" name="sup_hum" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["sup_hum"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="sup_hum" name="sup_hum" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Adelantar sitio prohibido:</div>
                    <?php if($row["ade_proh"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="ade_proh" name="ade_proh" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["ade_proh"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="ade_proh" name="ade_proh" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Imprudencia conductor:</div>
                    <?php if($row["imp_con"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="imp_con" name="imp_con" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["imp_con"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="imp_con" name="imp_con" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv1">Vehículo mal estacionado:</div>
                    <?php if($row["mal_est"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="mal_est" name="mal_est" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["mal_est"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="mal_est" name="mal_est" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Obras en la vía:</div>
                    <?php if($row["obras_via"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="obras_via" name="obras_via" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["obras_via"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="obras_via" name="obras_via" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Imprudencia del peaton:</div>
                    <?php if($row["imp_peat"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="imp_peat" name="imp_peat" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["imp_peat"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="imp_peat" name="imp_peat" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv1">Vehiluco en contravia:</div>
                    <?php if($row["contravia"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="contravia" checked name="contravia" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["contravia"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="contravia" name="contravia" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Semoviente en la vía:</div>
                    <?php if($row["sem_via"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="sem_via" name="sem_via" checked class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["sem_via"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="sem_via" name="sem_via" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <div class="texto_serv1">Huecos en la vía:</div>
                    <?php if($row["huecos_via"]=='X'){ ?>
                    <div class="check_serv1"><input type="checkbox" id="huecos_via" checked name="huecos_via" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                    <?php if($row["huecos_via"]==''){ ?>
                    <div class="check_serv1"><input type="checkbox" id="huecos_via" name="huecos_via" class="checks1" disabled="disabled"></div>
                    <?php } ?>
                </div>
                <div class="bloque2">
                    <div class="texto_serv1">Otros, Cual?:</div>
                    <div class="otro_serv1"><input type="text" id="hip_otros" name="hip_otros" class="sen-class1" disabled="disabled" value="<?php echo $row['hip_otros'] ?>"></div>
                </div>
            </div>
            <div class="sep"></div>
            <div class="contenedor5">
                <div class="global_obs">
                    <div class="titulos_obs"><b>DESCRIPCI&Oacute;N DE LOS HECHOS</b></div>
                    <div>
                        <textarea id="desc_hechos" name="desc_hechos" class="textarea_obs" disabled="disabled"><?php echo $row["descripcion"]; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="insp_botonera">
                <input type="button" id="regresar" name="regresar" value="Regresar" class="botones"  onclick="location.href='ver.php'">
                Inspector: <b><u><?php echo $row_usuario['us_nombre']." ".$row_usuario['us_apellido']; ?></u></b>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
                $('#imprimir').click(function(){
                window.open('imprimir_planilla.php?parte=<?php echo $id_parte; ?>');
            });
        });
    </script>
    </body>
</html>