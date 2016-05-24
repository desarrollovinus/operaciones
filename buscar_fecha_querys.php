<?php
session_start();
$tipo_us=$_SESSION["tipo"];
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Buscar Fecha</title>
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <script src="js/jscal2.js"></script>
        <script src="js/lang/es.js"></script>
        <script src="js/jquery-1.7.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="css/steel/steel.css" />
    </head>
    <script>
        $(document).ready(function(){
            //Esta función valida que el campo contenga algún valor, para que no liste toda la consulta
        function validar_campo(){
            if(document.seleccionar_fecha.fecha.value == ""){
                alert('Ingrese una fecha para realizar la búsqueda');
                return false;
            }else{
                return true;
            }//Fin if
        }//Fin validar_campo()
        
        //Calendario
        var cal = Calendar.setup({
            onSelect: function(cal) { cal.hide() },
            showTime: true
        });
        cal.manageFields("cal_1", "fecha", "%Y-%m-%d");
        })
    </script>
    <body onload="document.forms['buscar_fecha']['buscar_fecha'].focus()">
        <div id="ver">
            <div class="log">
            <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="seleccionar_fecha" name="seleccionar_fecha" action="ver_fecha_querys.php" method="post" onsubmit="return validar_campo();">
                    <table align="center">
                        <tr>
                            <div class="titulos">Seleccione la fecha que desea usar en la bit&aacute;cora:</div><br>
                        </tr>
                        <tr>
                            <td align="left">
                                <div>
                                    <img align="right" src="images/calendario.jpg" alt="Cal" id="cal_1" name="cal_1">
                                </div>
                            </td>
                            <td align="right">
                                <input type="text" id="fecha" name="fecha" class="sen-class1">
                            </td>
                        </tr>
                        <tr align="center">
                            <td align="center">
                                <input align="center" type="submit" id="buscar_fecha"  value="Buscar" name="buscar_fecha" class="bot"/>
                            </td>
                            <td align="center">
                                <input type="button" id="atras"  value="Regresar" name="atras" <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='ver_bit_insp.php'"  <?php  }?> class="bot"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>




