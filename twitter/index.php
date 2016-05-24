<?php
//date_default_timezone_set('America/Bogota');

//Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
//session_start();

$pagina_web = "http://www.vinus.com.co";
$pagina_web_quick = "http://www.hatovial.com/site_web_quickpass/";

//Se definen los mensajes que se podran enviar
$mensaje1 = "Las vías de la concesión Vinus (Km 1+000 hasta Km 40+900) no presentan ninguna novedad. ".$pagina_web;
$mensaje2 = "Concesión encargada de administrar, mejorar, mantener y operar la vía Cisneros - Nus - Alto Dolores. ".$pagina_web;
$mensaje3 = "La concesión cuenta con servicios de ambulancia, gr&uacute;as y carro taller. Más info: ".$pagina_web;

// $mensaje18 = "Quickpass 1/2: del 16 al 18 de octubre no habrá recargas por mejoras al sistema. Próximamente, 7 peajes para pago Quickpass.";
// $mensaje19 = "Quickpass 2/2: Señor usuario: recargue con anticipación, previendo la actividad del 16 al 18 de octubre.";
// $mensaje2 = "Tenga presente: la línea de emergencias 24 horas es 018000 52 44 77. ".$pagina_web;
// $mensaje3 = "Este espacio es usado solo como medio informativo. Si solicita mayor información, visite nuestra página web: ".$pagina_web;
// $mensaje6 = "Instalación QuickPass: lunes a viernes 9 a.m. a 12 m. y 2 p.m. a 5 p.m. Tel: 4012277 Ext. 120 ".$pagina_web_quick;
// $mensaje7 = "Instalación de tag QuickPass gratis en instalaciones de Hatovial. Detalles: 4012277 ".$pagina_web_quick;
// $mensaje8 = "Sr. usuario: El Carril 3 del Peaje Niquía (ambos sentidos) es exclusivo para paso con tag QuickPass ".$pagina_web_quick;
// $mensaje9 = "Los carriles 2 y 5 de Peaje Trapiche serán exclusivos para pago con tag QuickPass de lunes a viernes.";
// $mensaje10 = "Punto de instalación Quick Pass 1/5: Hatovial SAS - lunes a viernes 8am-12m y 2pm-5pm. Calle 59 # 48-35, Copacabana";
// $mensaje11 = "Punto de instalación Quick Pass 2/5: Texaco (Peaje El Trapiche), lunes a miércoles 2pm-5pm; viernes a sábado 2pm-5pm";
// $mensaje12 = "Punto de instalación Quick Pass 3/5: Estación de servicio ESSO Cocorolló. Autopista Norte Km 20, sentido Medellín-Barbosa";
// $mensaje13 = "Punto de instalación Quick Pass 4/5: Estación de servicio Zeuss. Calle 104 # 01-401 Km 18, Autopista Norte-Copacabana";
// $mensaje14 = "Punto de instalación Quick Pass 5/5: Car Center, Centro Comercial Oviedo. Carrera 43B # 6 Sur-140, Medellín";
// $mensaje15 = "Las vías del Aburrá Norte (Solla - Barbosa - Donmatías) presentan alto flujo vehicular. Transite con precaución";

// $semana_santa1 = "Peregrinos del Se&ntilde;or Ca&iacute;do, por favor usar el and&eacute;n y los puentes peatonales. #SemanaSanta";
// $semana_santa2 = "Peregrinos, les recordamos que el acceso a Girardota se har&aacute; por la v&iacute;a provisional. #SemanaSanta";
// $semana_santa3 = "Se&ntilde;or usuario, por favor tenga en cuenta que hay peregrinos en la v&iacute;a. #SemanaSanta";
?>

<html>
    <head>
        <?php
        //Inicio la session, para verificar si el usuario esta logueado, de lo contrario se devuelve al index.php
        session_start();
        $log = $_SESSION["log"];
        if ($log == 0){
            session_destroy();
        ?>
        <meta HTTP-EQUIV="REFRESH" content="0; url=../index.php">
        <?php
        }
        
        //Se conecta con la base de datos
        include("../funciones.php");
        $link=Conectarse();
        $ced=$_SESSION["ced"];
        ?>
        <link href="../css/estilos.css" rel="stylesheet" rev="stylesheet" type="text/css">
        <title>Enviar un Tweet</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <script>
        function deshabilitar(){
            document.getElementById("tweet1").checked = false;
            document.getElementById("tweet2").checked = false;
            document.getElementById("tweet3").checked = false;
            document.getElementById("tweet4").checked = false;
            document.getElementById("tweet5").checked = false;
            document.getElementById("tweet6").checked = false;
            document.getElementById("tweet7").checked = false;
        }
    </script>
    </head>
    <body>
        <form action="enviar/index.php" method="post">
            <div id="contenedor-logo">
                <div class="logo"></div>
                <div id="contenedor">
                    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="left" class="tabla">
                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">ENVIAR UNA PUBLICACI&Oacute;N SELECCIONANDO DIFERENTES OPCIONES</font></b></td>
                        </tr>
                        <tr>
                            <td>
                                <label>V&iacute;a*</label>
                                <select name="via" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="La vía desde el Km 001+000 al Km 012+000, sentido Norte - Sur">Km 001+000 al Km 012+000, Norte - Sur</option>
                                    <option value="La vía desde el Km 001+000 al Km 012+000, sentido Sur - Norte">Km 001+000 al Km 012+000, Sur - Norte</option>
                                    <option value="La vía desde el Km 012+001 al Km 029+000, sentido Norte - Sur">Km 012+001 al Km 029+000, Norte - Sur</option>
                                    <option value="La vía desde el Km 012+001 al Km 029+000, sentido Sur - Norte">Km 012+001 al Km 029+000, Sur - Norte</option>
                                    <option value="La vía desde el Km 029+001 al Km 040+900, sentido Norte - Sur">Km 029+001 al Km 040+900, Norte - Sur</option>
                                    <option value="La vía desde el Km 029+001 al Km 040+900, sentido Sur - Norte">Km 029+001 al Km 040+900, Sur - Norte</option>
                                </select>
                            </td>
                            <td>
                                <label>Estado*</label>
                                <select name="estado" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="no presenta ninguna novedad">Sin Novedad</option>
                                    <option value="presenta movilidad fluída">Movilidad Flu&iacute;da</option>
                                    <option value="presenta movilidad reducida">Movilidad Reducida</option>
                                    <option value="se encuentra en condiciones de vía húmeda">V&iacute;a H&uacute;meda</option>
                                    <option value="presenta cierre parcial">Cierre Parcial</option>
                                    <option value="presenta cierre total">Cierre Total</option>
                                </select>
                            </td>
                            <td>
                                <label>Causa(Opcional)</label>
                                <select name="causa" onChange="deshabilitar()">
                                    <option value=""></option>
                                    <option value="incidente de tránsito">Incidente de tr&aacute;nsito</option>
                                    <option value="accidente de tránsito">Accidente de Tr&aacute;nsito</option>
                                    <option value="alto flujo vehicular">Alto Flujo Vehicular</option>
                                    <option value="trabajos en la vía">Trabajos en la V&iacute;a</option>
                                    <option value="realización de evento público">Evento P&uacute;blico</option>
                                    <option value="manifestación pública">Manifestaci&oacute;n P&uacute;blica</option>
                                    <option value="realización de ciclovía">Ciclov&iacute;a</option>
                                    <option value="condiciones de lluvia">Condici&oacute;n Lluviosa</option>
                                    <option value="rehabilitación de vía">Rehabilitaci&oacute;n de v&iacute;a</option>
                                    <option value="pavimentación de vía">Pavimentaci&oacute;n de v&iacute;a</option>
                                    <option value="trabajos de modernización del peaje Niquía">Trabajos en el peaje Cisneros</option>
                                    <option value="congestión en el Peaje Niquía">Congestión en Peaje Cisneros</option>
                                </select>
                            </td>
                        </tr>

                        <tr align="center">
                            <td colspan="10" style="padding: 15px"><b><font size="2">ENVIAR UNA PUBLICACI&Oacute;N SELECCIONANDO UNO DE LOS MENSAJES PREDEFINIDOS</font></b></td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet1" value="<?php echo $mensaje1; ?>">
                                <?php echo $mensaje1; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet2" value="<?php echo $mensaje2; ?>">
                                <?php echo $mensaje2; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <input type="radio" name="tweet" id="tweet3" value="<?php echo $mensaje3; ?>">
                                <?php echo $mensaje3; ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 15px" align="center" colspan="10">
                                <input type="submit" id="guardar" name="guardar" class="button" value="Enviar Tweet">
                                <input type="button" name="salir" id="salir" class="button" value="Regresar" onclick="location.href='../querys.php'">
                                <a href="https://twitter.com/viasdelnus" target="_blank"><img src="../images/twitter2.png" style="vertical-align: middle" width="32" height="32"/></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>