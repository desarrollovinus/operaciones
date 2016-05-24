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
        <title>Registro de Ambulancia</title>
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
						});
					});
				});
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
			});
		</script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>

            <div id="contenedor_us_amb">
                <form action="guardar_amb.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <input type="text" id="id_parte" name="id_parte" class="sen-class" >
                        
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <input type="text" class="sen-class" readonly="readonly" id="via" name="via"></input>
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
                <div class="encabezado2">
                    <div class="cie_horas">
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">
                    <div class="titulo_cie">Fecha y Hora Pedido:</div>
                    <div class="campos_cie"><input type="text" id="h_ped" name="h_ped" class="sen-class"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="titulo_cie">Fecha y Hora llegada:</div>
                    <div class="campos_cie"><input type="text" id="h_lleg" name="h_lleg" class="sen-class"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                </div>
                <div class="cie_horas">
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>

                </div>
                <div class="cie_horas">


                    <div class="titulo_cie">Fecha y Hora Atencion:</div>
                    <div class="campos_cie"><input type="text" id="h_aten" name="h_aten" class="sen-class"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_3" name="cal_3"></div>
                    <div class="titulo_cie">Fecha y Hora Recepcion:</div>
                    <div class="campos_cie"><input type="text" id="h_rec" name="h_rec" class="sen-class"><img align="left" src="images/calendario.jpg" alt="Cal" id="cal_4" name="cal_4"></div>
                </div>
				<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "h_ped", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_2", "h_lleg", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_3", "h_aten", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_4", "h_rec", "%Y-%m-%d %H:%M");

					//]]></script>
            </div>
                 <div class="cont_us_inc">
                        <div class="titulo_inv"><b>INFORMACION DEL USUARIO</b></div>
                        <div class="bloque_inv">
                        <div class="bloque1_inv">
                        <div class="texto_inv">Nombre del usuario</div>
                        <div class="campo_inv"><input type="text" id="nom_inv" name="nom_inv" class="sen-class"></div>
                        <div class="texto_inv">Direccion de Residencia</div>
                        <div class="campo_inv"><input type="text" id="dir_res" name="dir_res" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Cedula del usuario</div>
                        <div class="campo_inv"><input type="text" id="ced_inv" name="ced_inv" class="sen-class"></div>
                        <div class="texto_inv">Aseguradora responsable</div>
                        <div class="campo_inv"><input type="text" id="aseg" name="aseg" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Telefono</div>
                        <div class="campo_inv"><input type="text" id="tel_inv" name="tel_inv" class="sen-class"></div>
                        <div class="texto_inv">Nombre de acompañante</div>
                        <div class="campo_inv"><input type="text" id="nomb_acomp" name="nomb_acomp" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Placa del vehiculo</div>
                        <div class="campo_inv"><input type="text" id="placa_veh" name="placa_veh" class="sen-class"></div>
                        <div class="texto_inv">Telefono acompañante</div>
                        <div class="campo_inv"><input type="text" id="tel_acomp" name="tel_acomp" class="sen-class"></div>
                        </div>
</div>
                   </div>
                        <div class="causa">
                            <div class="titulo_inv"><b>CAUSA EXTERNA QUE ORIGINA LA ATENCION</b></div>
                            <div class="titulo_inv"><select id="causa" name="causa" class="cam_causa">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Accidente de Transito">Accidente de Transito</option>
                                    <option value="Accidente de Trabajo">Accidente de Trabajo</option>
                                    <option value="Enfermedad General">Enfermedad General</option>
                                    <option value="Victimas y Daños a Obras o Instalaciones">Victimas y Daños a Obras o Instalaciones</option>
                                    <option value="Accidente Com&uacute;n">Accidente Com&uacute;n</option>
                                    <option value="Lesion por agresion">Lesion por agresion</option>
                                    <option value="Otro">Otro</option>
                                    </optgroup>
                            </select></div>
                              
               </div>
                    <div class="desc">
                     <div class="titulo_inv1"><b>ANTECEDENTES PERSONALES</b></div>
                     <div class="titulo_inv1"><b>EXAMEN FISICO</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Alergias:</div>
                        <div class="check_inc"><input type="checkbox" id="alergias" name="alergias" value="X" class="checks1"></div>
                        <div class="texto_inc">Frecuencia Cardiaca:</div>
                        <div class="otro_inc"><input type="text" id="fre_card" name="fre_card" class="sen-class"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Patologias:</div>
                        <div class="check_inc"><input type="checkbox" id="patologias" name="patologias" value="X" class="checks1"></div>
                        <div class="texto_inc">Frecuencia respiratoria:</div>
                        <div class="otro_inc"><input type="text" id="fre_resp" name="fre_resp" class="sen-class"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Medicacion:</div>
                        <div class="check_inc"><input type="checkbox" id="medicacion" name="medicacion"  value="X" class="checks1"></div>
                        <div class="texto_inc">Presion arterial:</div>
                        <div class="otro_inc"><input type="text" id="pres_arte" name="pres_arte" class="sen-class"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Liquidos y alimentos:</div>
                        <div class="check_inc"><input type="checkbox" id="liq_alim" name="liq_alim" value="X" class="checks1"></div>
                        <div class="texto_inc">Temperatura:</div>
                        <div class="otro_inc"><input type="text" id="temp" name="temp" class="sen-class"></div>

                    </div>
                    
               </div>
                    <div class="desc12">
                     <div class="titulo_inv"><b>PROCEDIMIENTOS</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Oxigenacion:</div>
                        <div class="check_inc"><input type="checkbox" id="oxig" name="oxig" value="X" class="checks1"></div>
                        <div class="texto_inc">Ventilacion:</div>
                        <div class="check_inc"><input type="checkbox" id="vent" name="vent" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Aspiracion:</div>
                        <div class="check_inc"><input type="checkbox" id="aspir" name="aspir" value="X" class="checks1"></div>
                        <div class="texto_inc">Intubacion:</div>
                        <div class="check_inc"><input type="checkbox" id="intub" name="intub" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">R.C.C.P:</div>
                        <div class="check_inc"><input type="checkbox" id="rccp" name="rccp" value="X" class="checks1"></div>
                        <div class="texto_inc">Desfibrilacion:</div>
                        <div class="check_inc"><input type="checkbox" id="desfi" name="desfi" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Monitoreo:</div>
                        <div class="check_inc"><input type="checkbox" id="monit" name="monit" value="X" class="checks1"></div>
                        <div class="texto_inc">Vendaje:</div>
                        <div class="check_inc"><input type="checkbox" id="vend" name="vend" value="X" class="checks1"></div>

                    </div>
                     <div class="bloque2">
                        <div class="texto_inc">Inmovilizacion:</div>
                        <div class="check_inc"><input type="checkbox" id="inmov" name="inmov" value="X" class="checks1"></div>
                        <div class="texto_inc">Collar cervical:</div>
                        <div class="check_inc"><input type="checkbox" id="collar" name="collar" value="X" class="checks1"></div>

                    </div>
                     <div class="bloque2">
                        <div class="texto_inc">Apoyo psicologico:</div>
                        <div class="check_inc"><input type="checkbox" id="apoy_psi" name="apoy_psi" value="X" class="checks1"></div>
                        <div class="texto_inc">Asepsia:</div>
                        <div class="check_inc"><input type="checkbox" id="asepsia" name="asepsia" value="X" class="checks1"></div>
                    </div>
                     <div class="bloque2">
                        <div class="texto_inc">Liquidos:</div>
                        <div class="check_inc"><input type="checkbox" id="liquidos" name="liquidos" value="X" class="checks1"></div>
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_pro" name="otros_pro" class="sen-class"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Medicacion:</div>
                        <div class="check_inc"><input type="checkbox" id="medicacion_pro" value="X" name="medicacion_pro" class="checks1"></div>
                        
                    </div>

               </div>
                    <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION DE HALLAZGOS</b></div>
                            <textarea id="desc_hall" name="desc_hall" class="textare_inc"></textarea>

                        </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DIAGNOSTICO</b></div>
                            <textarea id="diag" name="diag" class="textare_inc"></textarea>
                            
                        </div>

                    <div class="trasl">
                     <div class="titulo_inv"><b>HOSPITAL O CLINICA DE TRASLADO</b></div>

                    <div class="bloque2">
                        <div class="texto_tras">Marco Fidel Suarez:</div>
                        <div class="check_tras"><input type="checkbox" id="mfs" name="mfs" value="X" class="checks1"></div>
                        <div class="texto_tras">Santa Margarita Copacabana:</div>
                        <div class="check_tras"><input type="checkbox" id="smc" name="smc" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_tras">San Rafael Girardota:</div>
                        <div class="check_tras"><input type="checkbox" id="srg" name="srg" value="X" class="checks1"></div>
                        <div class="texto_tras">San vicente de Paul Barbosa:</div>
                        <div class="check_tras"><input type="checkbox" id="svpb" name="svpb" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_tras">Francisco Eladio Barrera Don Matias:</div>
                        <div class="check_tras"><input type="checkbox" id="febdm" name="febdm" value="X" class="checks1"></div>
                        <div class="texto_tras">Clinica del Norte del Valle de Aburra Niquia:</div>
                        <div class="check_tras"><input type="checkbox" id="cnvn" name="cnvn" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_tras">Salud Total Bello:</div>
                        <div class="check_tras"><input type="checkbox" id="stb" name="stb" value="X" class="checks1"></div>
                        <div class="texto_tras">Otro Centro Asistencial:</div>
                        <div class="check_tras"><input type="checkbox" id="otc" name="otc" value="X" class="checks1"></div>

                    </div>
                     <div class="bloque2">
                        <div class="texto_tras">Sin Traslado:</div>
                        <div class="check_tras"><input type="checkbox" id="st" name="st" value="X" class="checks1"></div>
                        
                    </div>
                    

               </div>
    
                    <div class="cont_us_inc">
                        <div class="titulo_inv"><b>SITO DE TRASLADO Y OTRA INFORMACION</b></div>
                        <div class="bloque_inv">
                        <div class="bloque1_inv">
                        <div class="texto_inv">Operador de la ambulancia</div>
                        <div class="campo_inv"><input type="text" id="op_amb" name="op_amb" class="sen-class"></div>
                        <div class="texto_inv">Nombre de la E.P.S</div>
                        <div class="campo_inv"><input type="text" id="nom_eps" name="nom_eps" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Tripulante Auxiliar</div>
                        <div class="campo_inv"><input type="text" id="trip_aux" name="trip_aux" class="sen-class"></div>
                        <div class="texto_inv">Estado de entrega</div>
                        <div class="campo_inv"><select id="est_ent" name="est_ent" class="sen-class">
                                <optgroup label="Seleccione">
                                    <option value=""></option>
                                    <option value="Conciente">Conciente</option>
                                    <option value="Inconciente">Inconciente</option>
                                    <option value="Muerto">Muerto</option>
                                    </optgroup>
                            </select>
                        </div>
                        </div>

                        <div class="bloque1_inv">
                        <div class="texto_inv">Ambulancia No.</div>
                        <div class="campo_inv"><input type="text" id="num_amb" name="num_amb" class="sen-class"></div>
                        <div class="texto_inv">Medico quien recibe.</div>
                        <div class="campo_inv"><input type="text" id="medico" name="medico" class="sen-class"></div>
                        </div>

                        <div class="bloque1_inv">
 
                        <div class="texto_inv"></div>
                        <div class="campo_inv">
                            <input type="submit" id="guardar" name="guargar" Value="Guardar" class="bot">
                            <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                        </div>
                        </div>
                        </div>

                   </div>

                    </form>
                  </div>
                </body>
                </html>