<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
                <form id="imp_bit" action="pdf_bit.php" method="post">
                    <div class="imp_bit">
                        <div class="titulos">Ingresa el primer consecutivo:</div>
                        <div class="campos"><input type="text" id="pri_con" name="pri_con"></div>
                        <div class="titulos">Infresa el ultimo consecutivo:</div>
                        <div class="campos"><input type="text" id="seg_con" name="seg_con"></div>
                        <div class="boton">
                        <input type="submit" id="imp"  value="Imprimir" name="imp" class="bot"/>
                        <input type="button" id="imp"  value="Regresar" name="imp" class="bot" onclick="location.href='querys.php'"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
