<?php
session_start();
$tipo_us=$_SESSION["tipo"];
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Buscar Placa</title>
    </head>
    
    <script type="text/javascript">
        //Esta función valida que el campo contenga algún valor, para que no liste toda la consulta
        function validar_campo(){
            if(document.buscar_placa.buscar_placa.value == ""){
                alert('Ingrese algún dato para buscar la placa');
                return false;
            }else{
                return true;
            }//Fin if
        }//Fin validar_campo()        
    </script>
    
    <body onload="document.forms['buscar_placa']['buscar_placa'].focus()">
        <div id="ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="buscar_placa" name="buscar_placa" action="ver_placas.php" method="post" onsubmit="return validar_campo();">
                    <div class="titulos">Ingrese un valor de la placa o el n&uacute;mero completo:</div>
                    <div class="campos"><input type="text" id="buscar_placa" name="buscar_placa" class="campo_ver"></div>
                    <table align="center">
                        <tr></tr>
                        <tr>
                            <td><div class="bot"><input type="submit" id="bot_buscarl_placa"  value="Buscar" name="ver_placas" class="bot"/></div></td>
                            <td><input type="button" id="atras"  value="Regresar" name="atras" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>




