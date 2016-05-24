<?php
//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$ced=$_SESSION["ced"];
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Inspectores</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
    </head>
    <body>

            <?php
            //Se lee el registro que se acaba de insertar
            $consulta="SELECT * FROM tbl_parte where motivo_parte=''";
            $resul= mysql_query($consulta,$link);

           ?>


            <div id="contenedor_insp">
                <form action="guardar_acc_up.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <select id="id_parte" name="id_parte">
                    <optgroup label="Seleccione">
                    <option value=""></option>
                    <?php while($row = mysql_fetch_array($resul)){?>
                    <option value="<?php echo $row[id_parte]; ?>"><?php echo $row[id_parte]; ?></option>
                    <?php } ?>
                    </optgroup>
                    </select>
                    </div>
                    </div>

                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <select id="via" name="via" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="2510">2510</option>
                            <option value="6205">6205</option>
                            <option value="Departamental">Departamental</option>
                            </optgroup>
                            </select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="1">Tramo 1</option>
                            <option value="4">Tramo 4</option>
                            <option value="5">Tramo 5</option>
                            <option value="6">Tramo 6</option>
                            <option value="8">Tramo 8</option>
                            <option value="9">Tramo 9</option>
                            <option value="10">Tramo 10</option>
                            </optgroup>
                            </select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Calzada</b>
                    </div>
                    <div class="campos">
                        <select id="calzada" name="calzada" class="sen-class">
                            <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="W">W</option>
                            <option value="E">E</option>
                            <option value="N/A">N/A</option>
                            <option value="W/E">W/E</option>
                            </optgroup>
                            </select>
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Abscisa</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="abcisa" name="abcisa" class="sen-class">
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
                <div class="titulos1">Nombre tramo:</div>
                <div class="campos1"><input type="text" id="nom_tramo" name="nom_tramo" class="sen-class" /></div>
                </div>
                </div>

                <div class="sep"></div>
                <div class="contenedor2">

                <div class="datos_acc">
                    <div class="titulo_datos"> <b>DATOS DEL ACCIDENTE</b></div>

                    <div class="texto_datos">Formato de las fechas:</div>
                    <div class="campo_datos">(YYYY-MM-DD HH:MM)</div>
                    <div class="texto_datos">Fecha y hora de atención:</div>
                    <div class="campo_datos"><input type="text" id="fec_ini" name="fec_ini" class="sen-class1">
                        </div>
                    <div class="texto_datos">Fecha y hora de termino:</div>
                    <div class="campo_datos"><input type="text" id="fec_fin" name="fec_fin" class="sen-class1">
                    </div>

                    <div class="texto_datos">No. carriles obstruidos:</div>
                    <div class="campo_datos"><input type="text" id="c_obs" name="c_obs" class="sen-class2"></div>
                    <div class="texto_datos">Se produjo fuego?:</div>
                    <div class="campo_datos"><select id="fuego" name="fuego" class="sen-class2">
                    <optgroup label="Seleccione">
                    <option value=""></option>
                    <option value="SI">Si</option>
                    <option value="NO">No</option>
                    </optgroup>
                    </select></div>
                    <div class="texto_datos">Daños en la obra?:</div>
                    <div class="campo_datos"><select id="dano_via" name="dano_via" class="sen-class2">
                    <optgroup label="Seleccione">
                    <option value=""></option>
                    <option value="SI">Si</option>
                    <option value="NO">No</option>
                    </optgroup>
                    </select></div>


                </div>

                    <div class="tipo_acc">
                        <div class="titulo_acc"><b>TIPO DE ACCIDENTE</b></div>

                       <div class="bloque21">
                        <div class="texto_tipo">Choque contra vehiculo:</div>
                        <div class="check_tipo"><input type="checkbox" id="choque_veh" name="choque_veh" value="X" class="checks1"></div>
                        <div class="texto_tipo">Choque contra objeto fijo:</div>
                        <div class="check_tipo"><input type="checkbox" id="ch_obj" name="ch_obj" value="X" class="checks1" ></div>
                        <div class="texto_tipo">Atropello:</div>
                        <div class="check_tipo"><input type="checkbox" id="atrop" name="atrop" value="X" class="checks1"></div>
                        <div class="texto_tipo">Volcamiento:</div>
                        <div class="check_tipo"><input type="checkbox" id="volc" name="volc" value="X" class="checks1"></div>
                        <div class="texto_tipo">Caida del ocupante:</div>
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
                    <div class="titulo_serv"><b>TIPO DE SERVICIO PRESENTE PARA LA ATENCION</b></div>
                    <div class="bloque2">
                        <div class="texto_serv">Ambulancia:</div>
                        <div class="check_serv"><input type="checkbox" id="amb" name="amb" value="X" class="checks1"></div>
                        <div class="texto_serv">Bomberos:</div>
                        <div class="check_serv"><input type="checkbox" id="bom" name="bom" value="X" class="checks1"></div>
                        <div class="texto_serv">Inspector Vial:</div>
                        <div class="check_serv"><input type="checkbox" id="ins_vial" name="ins_vial" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Grua Concesión:</div>
                        <div class="check_serv"><input type="checkbox" id="grua" name="grua" value="X" class="checks1"></div>
                        <div class="texto_serv">Defensa Civil:</div>
                        <div class="check_serv"><input type="checkbox" id="def_civil" name="def_civil" value="X" class="checks1"></div>
                        <div class="texto_serv">Policia Transito:</div>
                        <div class="check_serv"><input type="checkbox" id="pol_tran" name="pol_tran" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Agentes de Transito:</div>
                        <div class="check_serv"><input type="checkbox" id="age_tran" name="age_tran" value="X" class="checks1"></div>
                        <div class="texto_serv">Fiscalia:</div>
                        <div class="check_serv"><input type="checkbox" id="fisc" name="fisc" value="X" class="checks1"></div>
                        <div class="texto_serv">Mantenimiento:</div>
                        <div class="check_serv"><input type="checkbox" id="mant" name="mant" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Señalización:</div>
                        <div class="check_serv"><input type="checkbox" id="sena" name="sena" value="X" class="checks1"></div>
                        <div class="texto_serv">Director Operativo:</div>
                        <div class="check_serv"><input type="checkbox" id="dir_ope" name="dir_ope" value="X" class="checks1"></div>
                        <div class="texto_serv">Residente Operativo:</div>
                        <div class="check_serv"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_serv">Policia Nacional:</div>
                        <div class="check_serv"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1"></div>
                        <div class="texto_serv">Policia de carreteras:</div>
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
                <div class="texto_cond">Iluminacion</div>
                <div class="campos_cond"><select id="ilum_cond" name="ilum_cond" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
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
                            <option value=""></option>
                            <option value="Seca">Seca</option>
                            <option value="Humedo">Humedo</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Rodadura Limpieza</div>
                <div class="campos_cond"><select id="rodlim_cond" name="rodlim_cond" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
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
                            <option value=""></option>
                            <option value="Nulo">Nulo</option>
                            <option value="Bajo">Bajo</option>
                            <option value="Medio">Medio</option>
                            <option value="Alto">Alto</option>
                            </optgroup>
                            </select></div>
                </div>
                <div class="global_cond">
                <div class="texto_cond">Daños a la vía</div>
                <div class="campos_cond"><select id="danos_cond" name="danos_cond" class="sen-class">
                        <optgroup label="Seleccione">
                            <option value=""></option>
                            <option value="Barrera_nes_yersey">Barrera New Yersey</option>
                            <option value="Barrera_peaje">Barrera Peaje</option>
                            <option value="Cabina_peaje">Cabina Peaje</option>
                            <option value="Defensa_seguridad">Defensa de seguridad</option>
                            <option value="Señal">Señal</option>
                            <option value="Ninguno">Ninguno</option>
                            </optgroup>
                            </select></div>
                </div>
                </div>
                </div>

                <div class="sep"></div>
                <div class="contenedor5">
                <div class="global_obs">
                <div class="titulos_obs">Hipotesis</div>
                <div ><textarea id="hipotesis" name="hipotesis" class="textarea_obs"></textarea></div>
                </div>
                    <div class="global_obs">
                    <div class="titulos_obs">Descripcion de los hechos</div>
                    <div ><textarea id="desc_hechos" name="desc_hechos" class="textarea_obs"></textarea></div>
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
