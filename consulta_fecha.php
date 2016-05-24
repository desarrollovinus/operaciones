<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div id="pag">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="listado4.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa la fecha inicial:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)</div>
                        <div class="campos"><input type="text" id="pri_fec" name="pri_fec"></div>
                        <div class="titulos">Infresa la fecha final:</div>
                        <div class="titulos">(YYYY-MM-DD HH:MM)</div>
                        <div class="campos"><input type="text" id="seg_fec" name="seg_fec"></div>
                        <div class="boton"><input type="submit" id="imp"  value="Mostrar" name="imp" class="bot"/></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>