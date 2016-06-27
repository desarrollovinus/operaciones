<?php
switch($_POST["info"]) {
    case "Accidentes":
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_accidentes.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">//<![CDATA[

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
    case "Incidentes":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_incidentes.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>
<?php
case "Emergencias":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_emergencias.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>
<?php
case "Otros":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_otros.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>
<?php
case "Cierre de Via":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_cierre.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>
<?php
case "Ambulancia":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_ambulancia.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>
<?php
case "Gruas":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_gruas.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
        break;
?>

<?php
case "Involucrados":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
		<script src="js/jscal2.js"></script>
		<script src="js/lang/es.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_involucrados.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
						<script type="text/javascript">

						  var cal = Calendar.setup({
							  onSelect: function(cal) { cal.hide() },
							  showTime: false,
							  bottomBar: false
						  });
						  cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
						  cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

					</script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
break;

case "No atendidos":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script src="js/jscal2.js"></script>
        <script src="js/lang/es.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="reportes/no_atendidos.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <select id="motivo_parte" name="motivo_parte" class="sen-class">
                            <option value="0" selected>Todos</option>
                            <option value="Accidente">Accidentes</option>
                            <option value="Incidente">Incidentes</option>
                        </select>
                        <script type="text/javascript">//<![CDATA[

                          var cal = Calendar.setup({
                              onSelect: function(cal) { cal.hide() },
                              showTime: false,
                              bottomBar: false
                          });
                          cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
                          cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

                    //]]></script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
break;
?>
<?php
case "Informe gerencial":
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script src="js/jscal2.js"></script>
        <script src="js/lang/es.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
        <title></title>
    </head>
    <body>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="info_gerencial.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1"></div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Ingresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)<img align="left" src="images/calendario.jpg" alt="Cal" id="cal_2" name="cal_2"></div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
                        <script type="text/javascript">

                          var cal = Calendar.setup({
                              onSelect: function(cal) { cal.hide() },
                              showTime: false,
                              bottomBar: false
                          });
                          cal.manageFields("cal_1", "pri_fec", "%Y-%m-%d 00:00");
                          cal.manageFields("cal_2", "seg_fec", "%Y-%m-%d 00:00");

                    </script>
                        <div class="boton">
                            <input type="button" id="regresar"  value="Regresar" name="regresar" class="bot" onclick="location.href='informes.php'"/>
                            <input type="submit" id="generar"  value="Generar" name="generar" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
break;
}
?>
