<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Informes</title>
    </head>
    <body>
        <div id="informes">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="fecha_infor.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione el informe deseado:</div>
                        <div class="boton1">
                            <input type="submit" id="info"  value="Accidentes" name="info" class="bot"/>
                            <input type="submit" id="info"  value="Incidentes" name="info" class="bot"/>
                            <input type="submit" id="info"  value="Emergencias" name="info" class="bot"/>
                            <input type="submit" id="info"  value="Otros" name="info" class="bot"/>
                        </div>
                        <div class="boton1">
                            <input type="submit" id="info"  value="Involucrados" name="info" class="bot"/>
                            <input type="submit" id="info"  value="Cierre de Via" name="info" class="bot"/>
                            <input type="submit" id="info"  value="Ambulancia" name="info"class="bot"/>
                            <input type="submit" id="info"  value="Gruas" name="info" class="bot"/>
                            <input type="submit" id="info"  value="No atendidos" name="info" class="bot"/>
                        </div>
                        <div class="boton1">
                            <input type="submit" id="info"  value="Informe gerencial" name="info" class="bot"/>
                        </div>
                        <div class="boton"><input type="button" id="atras"  value="Regresar" name="atras" onclick="location.href='querys.php'" class="bot"/></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>