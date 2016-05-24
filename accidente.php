<?php
//Se define la zona horaria
date_default_timezone_set('America/Bogota');

include 'funciones.php';

//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();

$log=$_SESSION["log"];

?>
<html>
    <head>
       <?php
       $link=Conectarse();
       $ced=$_SESSION["ced"];
       
       if ($log==0){
           session_destroy();
            ?>
        <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
        <?php
        }
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
                            $("#punto").val("");
                            $("#punto").attr("title","");
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
                                /*select_abscisas = "<option value='Seleccione'>Seleccione</option>";
                                for(i = 2; i < longitud; i+=2){
                                id=array_datos[i];
                                abscisa=array_datos[i+1];
                                select_abscisas += "<option value="+ id + ">" + abscisa + "</option>";
                                }
                                $("#abscisa").html(select_abscisas);*/
                            });//Fin post
                        });//Fin each
                    });//FIn change
                    /*$("#abscisa").change(function () {
                            $("#abscisa option:selected").each(function () {
                                elegido=$(this).val();
                                $("#punto").val("");
                                $("#punto").attr("title","");
                                if(elegido=="Seleccione"){
                                        return false;
                                }
                                $.post("abscisa.php", { elegido: elegido }, function(data){
                                        $("#punto").val(data);
                                        $("#punto").attr("title",data);
                                });			
                            });
                    });*/
                });//Fin document.ready
            </script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>
        <?php
        $fechahora= date('Y-m-d H:i:s');
        ?>
        <div id="contenedor_insp">
            <form action="guardar_acc.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
                <div id="contenedor-logo">
                    <div class="logo"></div>
                </div>
                <div class="encabezado">
                    <div class="global">
                        <div class="campos">
                            <input type="hidden" id="fecha" name="fecha" value="<?php echo $fechahora;?>" >
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Tramo</b>
                        </div>
                        <div class="campos">
                            <select id="tramo" name="tramo" class="sen-class">
                                <option value="" selected></option>
                                <?php
                                $consulta = "select * from tbl_tramos order by id";
                                $resultado = mysql_query($consulta,$link);
                                while($tramo = mysql_fetch_assoc($resultado)){
                                    echo "<option value='".$tramo["id"]."'>Tramo ".$tramo["id"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Nombre</b>
                        </div>
                        <div class="campos">
                            <input type="text" id="nom_tramo" name="nom_tramo" class="sen-class" readonly="readonly" />
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Via</b>
                        </div>
                        <div class="campos">
                            <input type="text" class="sen-class" readonly="readonly" id="via" name="via">
                        </div>
                    </div>				
                    <div class="global">
                        <div class="titulos">
                            <b>Abscisa</b>
                        </div>
                        <div class="campos">
                            <!--<select id="abscisa" name="abscisa" class="sen-class">
                            </select>-->
                            <input type="text" id="abcisa" name="abcisa" class="sen-class">
                        </div>
                    </div>
                    <div class="global">
                        <div class="titulos">
                            <b>Calzada</b>
                        </div>
                        <div class="campos">
                            <select id="calzada" name="calzada" class="sen-class">
                                <option value=""></option>
                                    <?php
                                    $consulta = "select * from tbl_calzada order by id";
                                    $resultado = mysql_query($consulta,$link);
                                    while($calzada = mysql_fetch_assoc($resultado)){
                                        echo "<option value='".$calzada["nombre"]."'>".$calzada["nombre"]."</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="sep"></div>
                <div class="ubicacion">
                    <div class="global1">
                        <div class="titulos1">Punto de Referencia:</div>
                        <div class="campos1"><input type="text" id="punto" name="punto" class="sen-class" /></div>
                    </div>

                    <div class="global1">
                        <div>¿Fue atendido?
                            <input type="radio" name="atendido" value="1" />Si
                            <input type="radio" name="atendido" value="0" checked/>No
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
                    </div>
                <div class="sep"></div>
                <div class="contenedor2">
                    <div class="datos_acc">
                        <div class="titulo_datos"> <b>DATOS DEL ACCIDENTE</b></div>
                        <div class="texto_datos">Formato de las fechas:</div>
                        <div class="campo_datos">(AAAA-MM-DD HH:MM)</div>
                        <div class="texto_datos">Fecha y hora se produjo:</div>
                        <div class="campo_datos"><input type="text" id="fec_pro" name="fec_pro" class="sen-class1"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="texto_datos">Fecha y hora conocimiento:</div>
                        <div class="campo_datos"><input type="text" id="fec_con" name="fec_con" class="sen-class1"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="texto_datos">Fecha y hora de atenci&oacute;n:</div>
                        <div class="campo_datos"><input type="text" id="fec_ini" name="fec_ini" class="sen-class1"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_3" name="cal_3"></div>
                        <div class="texto_datos">Fecha y hora de t&eacute;rmino:</div>
                        <div class="campo_datos"><input type="text" id="fec_fin" name="fec_fin" class="sen-class1"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_4" name="cal_4"></div>
                            <script type="text/javascript">
                                var cal = Calendar.setup({
                                    onSelect: function(cal) { cal.hide() },
                                    showTime: true
                                });
                                cal.manageFields("cal_1", "fec_pro", "%Y-%m-%d %H:%M");
                                cal.manageFields("cal_2", "fec_con", "%Y-%m-%d %H:%M");
                                cal.manageFields("cal_3", "fec_ini", "%Y-%m-%d %H:%M");
                                cal.manageFields("cal_4", "fec_fin", "%Y-%m-%d %H:%M");
                        </script>
                        <div class="texto_datos">No. carriles obstruidos:</div>
                        <div class="campo_datos"><input type="text" id="c_obs" name="c_obs" class="sen-class2"></div>
                        <div class="texto_datos">Se produjo fuego?:</div>
                        <div class="campo_datos">
                            <select id="fuego" name="fuego" class="sen-class2">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="texto_datos">Da&ntilde;os en la obra?:</div>
                        <div class="campo_datos">
                            <select id="dano_via" name="dano_via" class="sen-class2">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="tipo_acc">
                        <div class="titulo_acc"><b>TIPO DE ACCIDENTE</b></div>
                        <div class="bloque21">
                            <div class="texto_tipo">Choque contra veh&iacute;culo:</div>
                            <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" value="X" class="checks1"></div>
                            <div class="texto_tipo">Choque contra objeto fijo:</div>
                            <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" value="X" class="checks1" ></div>
                            <div class="texto_tipo">Atropello:</div>
                            <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" value="X" class="checks1"></div>
                            <div class="texto_tipo">Volcamiento:</div>
                            <div class="check_tipo"><input type="checkbox" id="volc" name="volc" value="X" class="checks1"></div>
                            <div class="texto_tipo">Ca&iacute;da del ocupante:</div>
                            <div class="check_tipo"><input type="checkbox" id="cai_ocu" name="cai_ocu" value="X" class="checks1"></div>
                            <div class="texto_tipo">Choque con semoviente:</div>
                            <div class="check_tipo"><input type="checkbox" id="ch_sem" name="ch_sem" value="X" class="checks1"></div>
                            <div class="texto_tipo">Choque con metro o tren:</div>
                            <div class="check_tipo"><input type="checkbox" id="ch_tren" name="ch_tren" value="X" class="checks1"></div>
                            <div class="texto_tipo">Otros, Cual?:</div>
                            <div class="otro_tipo"><input type="text" id="otro_tipo" name="otro_acc" class="sen-class1"></div>
                        </div>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="contenedor3">
                    <div class="titulo_serv"><b>TIPO DE SERVICIO PRESENTE PARA LA ATENCI&Oacute;N</b></div>
                    <div class="bloque2">
                        <div class="texto_serv">Ambulancia:</div>
                        <div class="check_serv"><input type="checkbox" id="amb" name="amb" value="X" class="checks1"></div>
                        <div class="texto_serv">Bomberos:</div>
                        <div class="check_serv"><input type="checkbox" id="bom" name="bom" value="X" class="checks1"></div>
                        <div class="texto_serv">Inspector Vial:</div>
                        <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Gr&uacute;a Concesi&oacute;n:</div>
                        <div class="check_serv"><input type="checkbox" id="grua" name="grua" value="X" class="checks1"></div>
                        <div class="texto_serv">Defensa Civil:</div>
                        <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" value="X" class="checks1"></div>
                        <div class="texto_serv">Polic&iacute;a Tr&aacute;nsito:</div>
                        <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Agentes de Tr&aacute;nsito:</div>
                        <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" value="X" class="checks1"></div>
                        <div class="texto_serv">Fiscal&iacute;a:</div>
                        <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" value="X" class="checks1"></div>
                        <div class="texto_serv">Mantenimiento:</div>
                        <div class="check_serv"><input type="checkbox" id="mant" name="mant" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Se&ntilde;alizaci&oacute;n:</div>
                        <div class="check_serv"><input type="checkbox" id="sena" name="sena" value="X" class="checks1"></div>
                        <div class="texto_serv">Director Operativo:</div>
                        <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" value="X" class="checks1"></div>
                        <div class="texto_serv">Residente Operativo:</div>
                        <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Polic&iacute;a Nacional:</div>
                        <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1"></div>
                        <div class="texto_serv">Polic&iacute;a de carreteras:</div>
                        <div class="check_serv"><input type="checkbox" id="pol_car" name="pol_car" value="X" class="checks1"></div>
                        <div class="texto_serv">Otros, Cual?:</div>
                        <div class="otro_serv"><input type="text" id="serv_otros" name="serv_otros" class="sen-class1"></div>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="contenedor4">
                    <div class="titulo_cond"><b>CONDICIONES</b></div>
                        <div class="bloque3">
                            <div class="global_cond">
                                <div class="texto_cond">Iluminaci&oacute;n</div>
                                <div class="campos_cond">
                                    <select id="ilum_cond" name="ilum_cond" class="sen-class">
                                    <option value=""></option>
                                        <?php
                                        $consulta = "select * from tbl_iluminacion";
                                        $resultado = mysql_query($consulta,$link);
                                        while($iluminacion = mysql_fetch_assoc($resultado)){
                                            echo "<option value='".$iluminacion["iluminacion"]."'>".$iluminacion["iluminacion"]."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="global_cond">
                                <div class="texto_cond">Rodadura</div>
                                <div class="campos_cond">
                                    <select id="rod_cond" name="rod_cond" class="sen-class">
                                        <option value=""></option>
                                            <?php
                                            $consulta = "select * from tbl_rodadura";
                                            $resultado = mysql_query($consulta,$link);
                                            while($rodadura = mysql_fetch_assoc($resultado)){
                                                echo "<option value='".$rodadura["rodadura"]."'>".$rodadura["rodadura"]."</option>";
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="global_cond">
                                <div class="texto_cond">Rodadura Limpieza</div>
                                <div class="campos_cond">
                                    <select id="rodlim_cond" name="rodlim_cond" class="sen-class">
                                        <option value=""></option>
                                            <?php
                                            $consulta = "select * from tbl_rodadura_limpieza";
                                            $resultado = mysql_query($consulta,$link);
                                            while($limpieza = mysql_fetch_assoc($resultado)){
                                                    echo "<option value='".$limpieza["limpieza"]."'>".$limpieza["limpieza"]."</option>";
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        <div class="global_cond">
                        <div class="texto_cond">Tr&aacute;fico</div>
                            <div class="campos_cond">
                                <select id="traf_cond" name="traf_cond" class="sen-class">
                                    <option value=""></option>
                                        <?php
                                        $consulta = "select * from tbl_trafico";
                                        $resultado = mysql_query($consulta,$link);
                                        while($trafico = mysql_fetch_assoc($resultado)){
                                            echo "<option value='".$trafico["trafico"]."'>".$trafico["trafico"]."</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="global_cond">
                            <div class="texto_cond">Da&ntilde;os a la v&iacute;a</div>
                            <div class="campos_cond">
                                <select id="danos_cond" name="danos_cond" class="sen-class">
                                    <option value=""></option>
                                        <?php
                                        $consulta = "select * from tbl_danos";
                                        $resultado = mysql_query($consulta,$link);
                                        while($dano = mysql_fetch_assoc($resultado)){
                                            echo "<option value='".$dano["dano"]."'>".$dano["dano"]."</option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="contenedor5">
                    <div class="titulo_cond"><b>HIPOTESIS</b></div>
                    <div class="bloque2">
                        <div class="texto_serv1">Embriaguez:</div>
                        <div class="check_serv1"><input type="checkbox" id="embri" name="embri" value="X" class="checks1"></div>
                        <div class="texto_serv1">Exceso de Velocidad:</div>
                        <div class="check_serv1"><input type="checkbox" id="exc_vel" name="exc_vel" value="X" class="checks1"></div>
                        <div class="texto_serv1">Fallas Mec&aacute;nicas:</div>
                        <div class="check_serv1"><input type="checkbox" id="fallas" name="fallas" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Falta de Precauci&oacute;n:</div>
                        <div class="check_serv1"><input type="checkbox" id="falta_pre" name="falta_pre" value="X" class="checks1"></div>
                        <div class="texto_serv1">No conservar la distancia:</div>
                        <div class="check_serv1"><input type="checkbox" id="no_dis" name="no_dis" value="X" class="checks1"></div>
                        <div class="texto_serv1">Obst&aacute;culo en la v&iacute;a:</div>
                        <div class="check_serv1"><input type="checkbox" id="obs_via" name="obs_via" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Superficie H&uacute;meda:</div>
                        <div class="check_serv1"><input type="checkbox" id="sup_hum" name="sup_hum" value="X" class="checks1"></div>
                        <div class="texto_serv1">Adelantar sitio prohibido:</div>
                        <div class="check_serv1"><input type="checkbox" id="ade_proh" name="ade_proh" value="X" class="checks1"></div>
                        <div class="texto_serv1">Imprudencia conductor:</div>
                        <div class="check_serv1"><input type="checkbox" id="imp_con" name="imp_con" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Veh&iacute;culo mal estacionado:</div>
                        <div class="check_serv1"><input type="checkbox" id="mal_est" name="mal_est" value="X" class="checks1"></div>
                        <div class="texto_serv1">Obras en la v&iacute;a:</div>
                        <div class="check_serv1"><input type="checkbox" id="obras_via" name="obras_via" value="X" class="checks1"></div>
                        <div class="texto_serv1">Imprudencia del peat&oacute;n:</div>
                        <div class="check_serv1"><input type="checkbox" id="imp_peat" name="imp_peat" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Veh&iacute;culo en contrav&iacute;a:</div>
                        <div class="check_serv1"><input type="checkbox" id="contravia" name="contravia" value="X" class="checks1"></div>
                        <div class="texto_serv1">Semoviente en la v&iacute;a:</div>
                        <div class="check_serv1"><input type="checkbox" id="sem_via" name="sem_via" value="X" class="checks1"></div>
                        <div class="texto_serv1">Huecos en la v&iacute;a:</div>
                        <div class="check_serv1"><input type="checkbox" id="huecos_via" name="huecos_via" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv1">Otros, Cual?:</div>
                        <div class="otro_serv1"><input type="text" id="hip_otros" name="hip_otros" class="sen-class1"></div>
                    </div>
                </div>
                <div class="sep"></div>
                <div class="contenedor5">
                    <div class="global_obs">
                        <div class="titulos_obs"><b>DESCRIPCI&Oacute;N DE LOS HECHOS</b></div>
                        <div><textarea id="desc_hechos" name="desc_hechos" class="textarea_obs"></textarea></div>
                    </div>
                    <div class="insp_botonera">
                        <input type="submit" id="guardar" name="guardar" value="Guardar" class="botones">
                        <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="botones" onclick="location.href='menu_insp.php'">
                    </div>
                </div>
            </form>
        </div>
        <?php mysql_close($link); ?>
    </body>
</html>