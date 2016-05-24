<?php
// Zona horaria
date_default_timezone_set('America/Bogota');

// Inicio de la sesión
session_start();

// Variables de sesión
$log = $_SESSION["log"];
$tipo_usuario = $_SESSION["tipo"];

/*
 * Estas validaciones se usan para impedir que el usuario tipo 1 o el no logueado se mueva por la url
 * hasta el menu de los inspectores, puesto que no debe tener acceso a ese menu
 */
if ($log == 0 || $tipo_usuario == 1){
    // Se cierra de la sesión
    session_destroy();
?>
    <!-- Etiquetas meta -->
    <meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php
} // if

// Archivos a incluir
include 'funciones.php';

// Variables de sesión
$ced=$_SESSION["ced"];

// Conexiones
$link = Conectarse();
?>

<html>
    <head>
        <!-- Etiquetas meta -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
        <!-- Título -->
        <title>Men&uacute; de Inspectores</title>
        
        <!-- Estilos -->
        <link href="css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        
        <!-- Scripts -->
        <script type="text/javascript">
            /**
             * Filtros
             */
            function filtrar(){
                // Variables
                var inspector = document.frm_menu.select_inspector.value;
                var tipo = document.frm_menu.select_tipo.value;
                var estado = document.frm_menu.select_estado.value;
                var direccion = "menu_insp.php";
                var parametros="";


                if(inspector != "INSPECTOR"){
                    parametros += "inspector=" + inspector;
                }

                if(tipo != "TIPO"){
                    if(parametros == ""){
                        parametros += "tipo=" + tipo;
                    }else{
                        parametros += "&tipo=" + tipo;
                    }
                }

                if(estado != "ESTADO") {
                    if(parametros == ""){
                        parametros += "estado=" + estado;
                    }else{
                        parametros += "&estado=" + estado;
                    }
                }

                if(parametros == ""){
                    location.href = direccion;
                }else{
                    location.href = direccion + "?" + parametros;
                }
            }
        </script>
    </head>
    <body>
        <!-- Formulario -->
        <form action="#" id="frm_menu" name="frm_menu" enctype="multipart/form-data" method="post">
            <div id="cont_menu">
                <div id="contenedor-logo" class="logo1">
                    <div class="logo"></div>
                    <div>
                        <br><br><br>
                        <input type="button" name="bit" id="bit" value="Ver Bitacora" onclick="location.href='ver_bit_insp.php'" class="botones">
                        <input type="button" name="fotos" id="fotos" value="Subir Fotos" onclick="location.href='upfotos.php'" class="botones">
                        <input type="button" name="modificar" id="modificar" value="Modificar" onclick="location.href='modif.php'" class="botones"><br>
                        <input type="button" name="ver" id="ver" value="Ver Parte" onclick="location.href='ver.php'" class="botones">
                        <input type="button" name="buscar_placa" id="buscar_placa" value="Buscar placa" onclick="location.href='buscar_placa.php'" class="botones">
                        <input type="button" name="salir" id="salir" value="Salir" onclick="location.href='salir.php'" class="botones">
                    </div>                  
                </div>

                <div id="cont_menu2">
                    <input type="button" name="acc" id="acc" value="Accidente" onclick="location.href='accidente.php'" onMouseOver=" mostrar('Asi_es_Municipio')" class="botones1">
                    <input type="button" name="inc" id="inc" value="Incidente" onclick="location.href='incidente.php'" class="botones1">
                    <input type="button" name="eme" id="eme" value="Emergencia" onclick="location.href='emergencias.php'" class="botones1">
                    <input type="button" name="otro" id="otro" value="Otro" onclick="location.href='otros.php'" class="botones1">
                    <input type="button" name="cierre" id="cierre" value="Cierre de Via" onclick="location.href='cierre_via.php'" class="botones1">
                    <input type="button" name="ambulancia" id="ambulancia" value="Ambulancia" onclick="location.href='ambulancia.php'" class="botones1">
                    <input type="button" name="grua" id="grua" value="Grua" onclick="location.href='grua.php'" class="botones1">

                    <div class="sep"></div>
                        <table border=1 cellspacing=1 cellpadding=1 width="800" >
                            <tr align="center">
                                <td>&nbsp;<b>PARTE&nbsp;</b></td>
                                <td>&nbsp;<b>FECHA Y HORA CREADO</b>&nbsp;</td>
                                <td>&nbsp;
                                    <select name="select_tipo" onChange="filtrar()">
                                        <option value="TIPO">CUALQUIER TIPO</option>
                                        <?php
                                        $resultado = mysql_query("select distinct motivo_parte from tbl_parte order by motivo_parte asc",$link);
                                        while($vect_acc = mysql_fetch_assoc($resultado)) {
                                            if(isset($_GET["tipo"]) and $_GET["tipo"]==$vect_acc["motivo_parte"]){
                                                echo "<option value='".$vect_acc["motivo_parte"]."' selected='selected'>".$vect_acc["motivo_parte"]."</option>";
                                                }
                                                else{
                                                    echo "<option value='".$vect_acc["motivo_parte"]."'>".$vect_acc["motivo_parte"]."</option>";
                                                }
                                        }
                                        ?>
                                    </select> &nbsp;
                                </td>
                                <td>&nbsp;
                                    <select name="select_inspector" onChange="filtrar()">
                                        <option value="INSPECTOR">TODOS LOS INSPECTORES</option>
                                        <?php
                                        $resultado = mysql_query("select id_usuario, CONCAT(us_nombre, ' ', us_apellido) as inspector from tbl_usuarios where us_tipo=2 order by inspector asc",$link);
                                        while($vect_acc = mysql_fetch_assoc($resultado)) {
                                            if(isset($_GET["inspector"]) and $_GET["inspector"]==$vect_acc["id_usuario"]){
                                                echo "<option value='".$vect_acc["id_usuario"]."' selected='selected'>".$vect_acc["inspector"]."</option>";
                                            }else{
                                                echo "<option value='".$vect_acc["id_usuario"]."'>".$vect_acc["inspector"]."</option>";
                                            }
                                        }
                                        ?>
                                    </select> &nbsp;
                                </td>
                                <td>&nbsp;
                                    <select name="select_estado" onChange="filtrar()">
                                        <option value="ESTADO">TODOS LOS ESTADOS</option>
                                        <option value=""></option>
                                        <option value="Incompleto">Incompleto</option>
                                    </select>&nbsp;
                                </td>
                                <td>&nbsp;<b>VER&nbsp;</b></td>
                            </tr>
                            <?php
                            if (isset($_REQUEST['pos']))
                                $inicio=$_REQUEST['pos'];
                            else
                                $inicio=0;
                                $impresos=0;
                                $consulta = "select * from tbl_parte, tbl_usuarios where tbl_parte.usuario=tbl_usuarios.id_usuario ";

                            if(isset($_GET)){
                                if(isset($_GET["inspector"])){
                                    $consulta .="and tbl_usuarios.id_usuario=".$_GET["inspector"]." ";
                                }
                                if(isset($_GET["tipo"])){
                                    $consulta .="and tbl_parte.motivo_parte='".$_GET["tipo"]."' ";
                                }						
                            }

                            $consulta .="order by id_parte desc limit $inicio, 200";
                            $result=mysql_query($consulta,$link);
                            $cont=0;

                            while($vect_acc = mysql_fetch_assoc($result)) {
                                $impresos++;
                                $cont=$cont+1;

                            switch($vect_acc["motivo_parte"]) {
                                case "Incidente":
                                    $actualizar = " ";

                                    if(incidente_incompleto($vect_acc["id_parte"],$link)){
                                        $actualizar = "Incompleto";
                                    }

                                    if(isset($_GET["estado"])) {
                                        if($_GET["estado"] == "Incompleto" and $actualizar == "Incompleto") {
                                            printf("
                                                <tr width=800>
                                                    <td>&nbsp;%s</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                </tr>",
                                                $vect_acc["id_parte"],
                                                $vect_acc["fechahora"],
                                                $vect_acc["motivo_parte"],
                                                $vect_acc["us_nombre"]." ".
                                                $vect_acc["us_apellido"],
                                                "<strong>".$actualizar."</strong>",
                                                $vect_acc["id_parte"]);
                                        }
                                    }else{
                                        printf("
                                        <tr width=800>
                                            <td>&nbsp;%s</td>
                                            <td>&nbsp;%s&nbsp;</td>
                                            <td>&nbsp;%s&nbsp;</td>
                                            <td>&nbsp;%s&nbsp;</td>
                                            <td>&nbsp;%s&nbsp;</td>
                                            <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                        </tr>",
                                        $vect_acc["id_parte"],
                                        $vect_acc["fechahora"],
                                        $vect_acc["motivo_parte"],
                                        $vect_acc["us_nombre"]." ".
                                        $vect_acc["us_apellido"],
                                        "<strong>".$actualizar."</strong>",
                                        $vect_acc["id_parte"]);
                                    }
                                break;

                                case "Otros":
                                    $actualizar = " ";
                                        
                                    if(otros_incompleto($vect_acc["id_parte"],$link)){
                                        $actualizar = "Incompleto";
                                    }
                                    
                                    if(isset($_GET["estado"])) {
                                        if($_GET["estado"] == "Incompleto" and $actualizar == "Incompleto") {
                                            printf(
                                            "<tr width=800>
                                                        <td>&nbsp;%s</td>
                                                        <td>&nbsp;%s&nbsp;</td>
                                                        <td>&nbsp;%s&nbsp;</td>
                                                        <td>&nbsp;%s&nbsp;</td>
                                                        <td>&nbsp;%s&nbsp;</td>
                                                        <td>&nbsp;%s&nbsp;</td>
                                                        <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                                    </tr>",
                                                $vect_acc["id_parte"],
                                                $vect_acc["fechahora"],
                                                $vect_acc["motivo_parte"],
                                                $vect_acc["us_nombre"]." ".
                                                $vect_acc["us_apellido"],
                                                "<strong>".$actualizar."</strong>",
                                                $vect_acc["id_parte"]);
                                            }
                                        }else{
                                            printf(
                                            "<tr width=800>
                                                <td>&nbsp;%s</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                            </tr>",
                                            $vect_acc["id_parte"],
                                            $vect_acc["fechahora"],
                                            $vect_acc["motivo_parte"],
                                            $vect_acc["us_nombre"]." ".
                                            $vect_acc["us_apellido"],"<strong>".
                                            $actualizar."</strong>",
                                            $vect_acc["id_parte"]);
                                        }
                                break;

                                case "Emergencia":
                                    printf(
                                    "<tr width=800>
                                        <td>&nbsp;%s</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                    </tr>",
                                    $vect_acc["id_parte"],
                                    $vect_acc["fechahora"],
                                    $vect_acc["motivo_parte"],
                                    $vect_acc["us_nombre"]." ".
                                    $vect_acc["us_apellido"]," ",
                                    $vect_acc["id_parte"]);
                                break;

                                case "Accidente":
                                    $actualizar = " ";
                                        if(accidente_incompleto($vect_acc["id_parte"],$link)){
                                            $actualizar = "Incompleto";
                                        }
                                        
                                        if(isset($_GET["estado"])) {
                                            if($_GET["estado"] == "Incompleto" and $actualizar == "Incompleto") {
                                                printf(
                                                "<tr width=800>
                                                    <td>&nbsp;%s</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td>&nbsp;%s&nbsp;</td>
                                                    <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                                </tr>",
                                                $vect_acc["id_parte"],
                                                $vect_acc["fechahora"],
                                                $vect_acc["motivo_parte"],
                                                $vect_acc["us_nombre"]." ".
                                                $vect_acc["us_apellido"],
                                                "<strong>".$actualizar."</strong>",
                                                $vect_acc["id_parte"]);
                                            }
                                        }else{
                                            printf(
                                            "<tr width=800>
                                                <td>&nbsp;%s</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td>&nbsp;%s&nbsp;</td>
                                                <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                            </tr>",
                                            $vect_acc["id_parte"],
                                            $vect_acc["fechahora"],
                                            $vect_acc["motivo_parte"],
                                            $vect_acc["us_nombre"]." ".
                                            $vect_acc["us_apellido"],
                                            "<strong>".$actualizar."</strong>",
                                            $vect_acc["id_parte"]);
                                        }
                                break;

                                case "":
                                    printf(
                                    "<tr width=800>
                                        <td>&nbsp;%s</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td>&nbsp;%s&nbsp;</td>
                                        <td  width='150'>&nbsp;%s&nbsp;</td>
                                        <td  width='150'>&nbsp;%s&nbsp;</td>
                                        <td align='center'><a href='ver_parte.php?ver_parte=%s'><img src='images/buscar.png'></a></td>
                                    </tr>",
                                    $vect_acc["id_parte"],
                                    $vect_acc["fechahora"],
                                    $vect_acc["motivo_parte"],
                                    $vect_acc["us_nombre"]." ".
                                    $vect_acc["us_apellido"],
                                    '<select style="font-size:12px;color:#006699;font-family:verdana;background-color:#ffffff;" name="menu'.$cont.'">
                                        <option value="http://localhost/operaciones/accidente_up.php">Accidente</option>
                                        <option value="http://localhost/operaciones/incidente_up.php">Incidente</option>
                                        <option value="http://localhost/operaciones/emergencias_up.php">Emergencia</option>
                                        <option value="http://localhost/operaciones/otros_up.php">Otros</option>
                                    </select>
                                    <input style="font-size:12px;color:#000000;font-family:verdana;background-color:#cccccc;" type="button" onClick="location=document.frm_menu.menu'.$cont.'.options[document.frm_menu.menu'.$cont.'.selectedIndex].value;" value="Ir">',
                                    $vect_acc["id_parte"]);
                                break;
                                }//Fin Switch
                            }//Fin While

                            mysql_close($link);

                            if ($inicio==0)
                              echo "<font size='3'>Anterior </font> ";
                            else{
                                $anterior=$inicio-200;
                                $direccion = "menu_insp.php?pos=$anterior";

                                if(isset($_GET["inspector"])){
                                    $direccion.="&inspector=".$_GET["inspector"];
                                }
                                if(isset($_GET["tipo"])){
                                    $direccion.="&tipo=".$_GET["tipo"];
                                }
                                echo "<a href='$direccion'><font size='3' color='dodgerblue'>Anterior </font></a>";
                            }

                            if ($impresos==200)
                            {
                                $proximo=$inicio+200;
                                $direccion = "menu_insp.php?pos=$proximo";

                                if(isset($_GET["inspector"])){
                                    $direccion.="&inspector=".$_GET["inspector"];
                                }

                                if(isset($_GET["tipo"])){
                                    $direccion.="&tipo=".$_GET["tipo"];
                                }
                                echo "<a href='$direccion'><font size='3' color='dodgerblue'>Siguiente </font></a> <br>";
                            }
                            else
                            echo "<font size='3'>Siguiente</font> <br>";
                            ?>
                        </table>
                    </div>
            </div>
        </form>
    </body>
</html>