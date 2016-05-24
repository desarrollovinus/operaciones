<?php
session_start();
include 'funciones.php';

$tipo_us=$_SESSION["tipo"];
$link=Conectarse();

//Validamos por dónde está llegando la variable, si es por POST o por GET
if(isset($_POST['ver_p'])){
    $parte= $_POST['ver_p'];
}else{
    $parte= $_GET['ver_parte'];
}

//COnsulta que trae el dato del parte
$consulta="SELECT * FROM tbl_parte where id_parte='$parte'";
$resul= mysql_query($consulta,$link);
$row = mysql_fetch_array($resul);
$_SESSION["id_parte"]=$row["id_parte"];

switch($row["motivo_parte"]) {
    //---------------------------Otros-------------------------------------------
    case "Otros":
        if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='0' )
            {
?>
                <meta HTTP-EQUIV="REFRESH" content="0; url=otros_ver.php">
                    <?php
            }else
                /**
                 * 
                 */
                if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){
                    ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" class="bot" onclick="location.href='otros_ver.php'"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                    </div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                         <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                    </div>
                    <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){
   
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        </div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Otros" name="otros" onclick="location.href='otros_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                    </div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}
break;

//---------------------------Accidente-------------------------------------------
 case "Accidente"://
if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){//
 ?>
<meta HTTP-EQUIV="REFRESH" content="0; url=accidente_ver.php">
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="accidente"  value="Accidente" name="accidente" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                    <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

    if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="accidente"  value="Accidente" name="accidente" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                    <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="accidente"  value="Accidente" name="accidente" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Accidente" name="otros" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Accidente" name="otros" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Accidente" name="otros" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        </div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Accidente" name="otros" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Accidente" name="otros" onclick="location.href='accidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                  </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}
break;

//---------------------------Incidente-------------------------------------------
 case "Incidente":
if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){
 ?>
<meta HTTP-EQUIV="REFRESH" content="0; url=incidente_ver.php">
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                 </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Incidente" name="otros" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else
    if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="incidente"  value="Incidente" name="incidente" onclick="location.href='incidente_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}

break;
//---------------------------Emergencias-------------------------------------------
 case "Emergencia":
if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){
 ?>
<meta HTTP-EQUIV="REFRESH" content="0; url=emergencias_ver.php">
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" onclick="location.href='cierre_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='1' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='0' && $row["grua"]=='0' ){

 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="cierre_via"  value="Cierre de via" name="cierre_via" class="bot" onclick="location.href='cierre_ver.php'"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='0' && $row["grua"]=='1' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="grua"  value="Grua" name="grua" onclick="location.href='grua_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='1' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="otros"  value="Emergencia" name="otros" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}else

if($row["cierre_via"]=='0' && $row["ambulancia"]=='1' && $row["grua"]=='0' ){
 ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Ver Parte</title>
    </head>
    <body>
        <div id="selec_ver">
            <div class="log">
                <div class="logo"><img src="images/logo.png" height="120" alt="desarrollo" style="margin-top:5px;"></div>
                <form id="imp_bit" action="ver_parte.php" method="post">
                    <div class="ver_parte">
                        <div class="titulos">Seleccione la planilla deseada:</div>
                        <div class="boton"><input type="button" id="emergencias"  value="Emergencia" name="emergencias" onclick="location.href='emergencias_ver.php'" class="bot"/>
                        <input type="button" id="ambulancia"  value="Ambulancia" name="ambulancia" onclick="location.href='ambulancia_ver.php'" class="bot"/></div>
                        <div class="boton">
                            <input type="button" id="atras"  value="Regresar" name="atras"  <?php if($tipo_us == 1){ ?> onclick="location.href='querys.php'"<?php } else {?> onclick="location.href='menu_insp.php'"  <?php  }?> class="bot"/>
                            <input type="button" id="atras"  value="Ver fotos" name="atras" onclick="location.href='ver_fotos.php'" class="bot"/>
                        </div>
                   </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
}
break;
}
?>