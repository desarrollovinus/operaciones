<?php
session_start();
$log=$_SESSION["log"];
if ($log==0){
    session_destroy();
     ?><meta HTTP-EQUIV="REFRESH" content="0; url=index.php"><?php
}
?>
<html>
    <head>
       <?php include 'funciones.php';
       $link=Conectarse();
       ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Cierre de via</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <body>

            <div id="contenedor_cierre">
                <form action="guardar_cie.php" name="frmins" id="frmins" enctype="multipart/form-data" method="post" >
            <div id="contenedor-logo">
            <div class="logo"></div>

            </div>
             <div class="encabezado1">
                <div class="cie_horas">

                    <div class="titulo_cie"><b>Relacionar al parte:</b></div>
                    <div class="campos_cie"><input type="text" id="id_parte" name="id_parte" class="sen-class1"></div>
                    
                </div>
            </div>
            <div class="encabezado">
                <div class="cie_horas">
                    <div class="titulo_cie"> </div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                    <div class="titulo_cie"></div>
                    <div class="campos_cie">(YYYY-MM-DD HH:MM)</div>
                </div>
                <div class="cie_horas">

                    <div class="titulo_cie">Fecha y Hora Inicio de Cierre:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                    <div class="campos_cie"><input type="text" id="h_ini_cie" name="h_ini_cie" class="sen-class1"></div>
                    <div class="titulo_cie">Fecha y Hora Fin de Cierre:<img align="right" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                    <div class="campos_cie"><input type="text" id="h_fin_cie" name="h_fin_cie" class="sen-class1"></div>
					<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: true
						  });
						  cal.manageFields("cal_1", "h_ini_cie", "%Y-%m-%d %H:%M");
						  cal.manageFields("cal_2", "h_fin_cie", "%Y-%m-%d %H:%M");

					//]]></script>
                </div>
            </div>
                 <div class="desc">
                 <div class="titulo_asis_ci"><b>SERVICIO PRESENTE EN EL CIERRE DE VIA</b></div>

                    <div class="bloque2">
                        <div class="texto_inc">Ambulancia:</div>
                        <div class="check_inc"><input type="checkbox" id="amb" name="amb" value="X" class="checks1"></div>
                        <div class="texto_inc">Grua Concesión:</div>
                        <div class="check_inc"><input type="checkbox" id="grua" name="grua" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Agentes de transito:</div>
                        <div class="check_inc"><input type="checkbox" id="agen_tran" name="agen_tran" value="X" class="checks1"></div>
                        <div class="texto_inc">Señalización:</div>
                        <div class="check_inc"><input type="checkbox" id="sena" name="sena" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Policía Nacional:</div>
                        <div class="check_inc"><input type="checkbox" id="pol_nal" name="pol_nal" value="X" class="checks1"></div>
                        <div class="texto_inc">Bomberos:</div>
                        <div class="check_inc"><input type="checkbox" id="bom" name="bom" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Defensa Civil:</div>
                        <div class="check_inc"><input type="checkbox" id="def_civil" name="def_civil" value="X" class="checks1"></div>
                        <div class="texto_inc">Fiscalia:</div>
                        <div class="check_inc"><input type="checkbox" id="fisc" name="fisc" value="X" class="checks1"></div>

                    </div>
                 <div class="bloque2">
                        <div class="texto_inc">Director Operativo:</div>
                        <div class="check_inc"><input type="checkbox" id="dir_ope" name="dir_ope" value="X" class="checks1"></div>
                        <div class="texto_inc">Policía de carreteras:</div>
                        <div class="check_inc"><input type="checkbox" id="pol_car" name="pol_car" value="X" class="checks1"></div>

                    </div>
                 <div class="bloque2">
                        <div class="texto_inc">Inspector Víal:</div>
                        <div class="check_inc"><input type="checkbox" id="ins_vial" name="ins_vial" value="X" class="checks1"></div>
                        <div class="texto_inc">Policia Transito:</div>
                        <div class="check_inc"><input type="checkbox" id="pol_tran" name="pol_tran" value="X" class="checks1"></div>

                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Mantenimiento:</div>
                        <div class="check_inc"><input type="checkbox" id="mant" name="mant" value="X" class="checks1"></div>
                        <div class="texto_inc">Residente Operativo:</div>
                        <div class="check_inc"><input type="checkbox" id="res_ope" name="res_ope" value="X" class="checks1"></div>
                    </div>
                    <div class="bloque2">
                        <div class="texto_inc">Otros, Cual?:</div>
                        <div class="otro_inc"><input type="text" id="otros_ser" name="otros_ser"  class="sen-class1"></div>
                    </div>

               </div>
                        <div class="desc1">
                            <div class="titulo_inv"><b>DESCRIPCION</b></div>
                            <textarea id="desc_hechos" name="desc_hechos"  class="textare_inc"></textarea>
                            <div class="boton_inc">
                                <input type="submit" id="guardar" name="guargar" Value="Guardar" class="bot">
                                <input type="button" id="regresar" name="regresar"  Value="Salir sin guardar" class="bot" onclick="location.href='menu_insp.php'">
                            </div>
                        </div>

                    </form>
                  </div>
                </body>
                </html>