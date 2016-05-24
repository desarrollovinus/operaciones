<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
$ced=$_SESSION["ced"];
$id_parte=$_SESSION["id_parte"];
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Otros</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>
            <?php
            //Se lee el registro que se acaba de insertar
            $consulta="SELECT * FROM tbl_otros where id_parte='$id_parte'";
            $resul= mysql_query($consulta,$link);
            $row = mysql_fetch_array($resul);
           ?>
            <div id="contenedor_otros_ins">
                <form action="mod_otros.php" name="frm_ot_insp" id="frm_ot_insp" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>
            </div>
            <div class="encabezado">
                <div class="global">
                    <div class="titulos">
                        <b>Consecutivo</b>
                    </div>
                    <div class="campos">
                        <?php echo $id_parte; ?>
                        <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $id_parte; ?>">
                    </div>
                    </div>
                <div class="global">
                    <div class="titulos">
                        <b>Via</b>
                    </div>
                    <div class="campos">
                        <select id="via" name="via" class="sen-class" >
                        <optgroup label="Seleccione">
                            <option value="<?php echo $row["via"]; ?>"><?php echo $row["via"]; ?></option>
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
                        <input type="text" id="abcisa" name="abcisa" value="<?php echo $row["abcisa"]; ?>" class="sen-class" >
                    </div>
                </div>
                </div>
                    <div class="encabezado2">
                <div class="cie_horas">
                <input type="hidden" id="id_parte" name="id_parte" value="<?php echo $id_parte;?>" >
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="campos_cie"><input type="text" id="h_ini_otros" name="h_ini_otros" value="<?php echo $row["h_ini_otros"]; ?>"  class="sen-class1"></div>
                    <div class="titulo_cie">Fecha y Hora Fin:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                    <div class="campos_cie"><input type="text" id="h_fin_otros" name="h_fin_otros" value="<?php echo $row["h_fin_otros"]; ?>" class="sen-class1"></div>
					<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "h_ini_otros", "%Y-%m-%d %H:%M:%S");
						  cal.manageFields("cal_2", "h_fin_otros", "%Y-%m-%d %H:%M:%S");

					//]]></script>
                </div>
            </div>
                 <div class="desc">
                     <div class="titulo_otr"><b>DESCRIPCION</b></div>
                     <textarea id="desc_otros" name="desc_otros"  class="text_otros_des" ><?php echo $row["descrip"]; ?></textarea>
                     <div class="boton_otros">
                     <input type="submit" id="guardar" name="guardar" Value="Guardar" class="bot" >
                     <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                 </div>
                </div>






                    </form>
                  </div>
                </body>
                </html>