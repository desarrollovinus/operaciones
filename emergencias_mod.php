<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$id_parte=$_SESSION["id_parte"];
?>

<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Emergencias</title>
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
            <?php
            $consulta="SELECT * FROM tbl_emergencias where id_parte='$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
           ?>
            <div id="contenedor_us_inc">
                <form action="mod_emergencias.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                     Consecutivo
                    </div>
                    <div class="campos">
                       <?php echo $row["id_parte"];?>
                       <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $row["id_parte"];?>">
                    </div>
                    </div>

                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <input type="text" class="sen-class" readonly="readonly" id="via" name="via" value="<?php echo $row["via"]; ?>">
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Tramo</b>
                    </div>
                    <div class="campos">
                        <select id="tramo" name="tramo" class="sen-class" >
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["tramo"]; ?>"><?php echo $row["tramo"]; ?></option>
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
                        <select id="calzada" name="calzada" class="sen-class" >
                            <optgroup label="Seleccione">
                            <option value="<?php echo $row["calzada"]; ?>"><?php echo $row["calzada"]; ?></option>
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
                        <input type="text" id="abcisa" name="abcisa" class="sen-class" value="<?php echo $row["abcisa"]; ?>">
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

                    <div class="titulo_cie">Fecha y Hora Inicio:</div>
                    <div class="campos_cie"><input type="text" id="h_ini_emer" name="h_ini_emer" class="sen-class1" value="<?php echo $row["h_ini_emer"]; ?>"  ></div>
                    <div class="titulo_cie">Fecha y Hora Fin:</div>
                    <div class="campos_cie"><input type="text" id="h_fin_emer" name="h_fin_emer" class="sen-class1" value="<?php echo $row["h_fin_emer"]; ?>"></div>
                </div>
            </div>
                        <div class="desc2">
                            <div class="titulo_inv"><b>TIPO DE EMERGENCIA</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Derrame de sustancias:</div>
                        <?php if($row["derr_sustancias"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="derra_sust" name="derra_sust" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["derr_sustancias"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="derra_sust" name="derra_sust" value="X" class="checks1"  ></div>
                        <?php } ?>
                        <div class="texto_inc">Derrumbe sobre la vía:</div>
                        <?php if($row["derr_via"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="derr_via" name="derr_via" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["derr_via"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="derr_via" name="derr_via" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Perdida de banca:</div>
                        <?php if($row["perd_banca"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="per_banca" name="per_banca" value="X" class="checks1" checked></div>
                        <?php } ?>
                        <?php if($row["perd_banca"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="per_banca" name="per_banca" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Fuga de gas u otros productos:</div>
                        <?php if($row["fuga_gas"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="fuga_gas" name="fuga_gas" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["fuga_gas"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="fuga_gas" name="fuga_gas" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Problemas de orden público:</div>
                        <?php if($row["prob_orden"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="pro_orden" name="pro_orden" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["prob_orden"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="pro_orden" name="pro_orden" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Caida de puente:</div>
                        <?php if($row["caida_puente"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="cai_puente" name="cai_puente" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["caida_puente"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="cai_puente" name="cai_puente" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Desborde de quebradas u otros:</div>
                        <?php if($row["desb_queb"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="des_quebrada" name="des_quebrada" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["desb_queb"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="des_quebrada" name="des_quebrada" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Inundación:</div>
                        <?php if($row["inundacion"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="inundacion" name="inundacion" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["inundacion"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="inundacion" name="inundacion" value="X" class="checks1" ></div>
                        <?php } ?>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Incendio:</div>
                        <?php if($row["incendio"]=='X'){ ?>
                        <div class="check_inc"><input type="checkbox" id="incendio" name="incendio" value="X" class="checks1" checked ></div>
                        <?php } ?>
                        <?php if($row["incendio"]==''){ ?>
                        <div class="check_inc"><input type="checkbox" id="incendio" name="incendio" value="X" class="checks1" ></div>
                        <?php } ?>
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_em" name="otros_em" class="sen-class" value="<?php echo $row["otros"]; ?>"></div>
                    </div>

               </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_eme" name="desc_eme" class="textare_inc" ><?php echo $row["descrip"]; ?></textarea>
                            <div class="boton_inc">
                                <input type="submit" id="guardar" name="guardar" Value="Guardar" class="bot">
                                <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                            </div>
                        </div>




                    </form>
                  </div>
                </body>
                </html>
