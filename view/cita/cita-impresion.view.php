<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Gecopa Web</title>
        <meta charset="utf-8" />

        <style type="text/css" media="print">
            @page{
                margin-top: -50px;
            }
        </style>
        <style>
            body {
                font-family: 'trebuchet ms', verdana, sans-serif;
            }
            table {
                border: 1px solid #000;
                border-spacing: 2px;
                margin: 5em auto 5em auto;
            }
            td {
                border-width: 5px;
                padding: 0.5em;
            }
        </style>

        <script>
            function printDiv(nombreDiv) {
                document.getElementById(nombreDiv).style.marginRight  = "0";
                document.getElementById(nombreDiv).style.marginTop = "0";
                document.getElementById(nombreDiv).style.marginLeft = "0";
                document.getElementById(nombreDiv).style.marginBottom = "0";
                document.getElementById('botonPrint').style.display = "none";

                var contenido= document.getElementById(nombreDiv).innerHTML;
                var contenidoOriginal= document.body.innerHTML;
                document.body.innerHTML = contenido;
                window.print();
                document.body.innerHTML = contenidoOriginal;
            }
        </script>
	</head>

    <?php
        $idCita = isset($_REQUEST['idCita']) ? $_REQUEST['idCita'] : '';
        $fechaCita = isset($_REQUEST['fechaCita']) ? $_REQUEST['fechaCita'] : '';
        $documentoCita = isset($_REQUEST['documentoCita']) ? $_REQUEST['documentoCita'] : '';
        $nombre1Cita = isset($_REQUEST['nombre1Cita']) ? $_REQUEST['nombre1Cita'] : '';
        $nombre2Cita = isset($_REQUEST['nombre2Cita']) ? $_REQUEST['nombre2Cita'] : '';
        $apellido1Cita = isset($_REQUEST['apellido1Cita']) ? $_REQUEST['apellido1Cita'] : '';
        $apellido2Cita = isset($_REQUEST['apellido2Cita']) ? $_REQUEST['apellido2Cita'] : '';
        $direccionCita = isset($_REQUEST['direccionCita']) ? $_REQUEST['direccionCita'] : '';
        $telefonoCita = isset($_REQUEST['telefonoCita']) ? $_REQUEST['telefonoCita'] : '';
        $formulaCita = isset($_REQUEST['formulaCita']) ? $_REQUEST['formulaCita'] : '';
    ?>

    <body id="cuerpoPagina">
        <div>
            <table>
                <tr>
                    <!-- <td><img style="width: 100px;" src="../../assets/img/abrir.png"/></td> -->
                    <td><img style="width: 150px;" src="http://sanlazarocolombia.com/images/Logotipo-San-Lazaro.png"/></td>
                    <td colspan="2">
                    <H3>CENTRO NATURISTA SAN LAZARO</H3>Cra 15 N° 16-34 - Pereira (COLOMBIA)<br>
                    Telefonos (6) 3352122 - Cel 310 544 4444<br>
                    Buscanos en internet como <b>www.sanlazarocolombia.com</b>
                    </td>
                    <td><img style="width: 100px;" src="../../assets/img/QR-San-Lazaro.png"/></td>                  
                </tr>

                <tr>
                    <td><B>ID Cita</B></td>
                    <td><?php echo $idCita; ?></td>
                    <td><B>Fecha</B></td>
                    <td><?php echo $fechaCita; ?></td>
                </tr>

                <tr>
                    <td><B>Nombres</B></td>
                    <td><?php echo $nombre1Cita . " " . $nombre2Cita; ?></td>
                    <td><B>Apellidos</B></td>
                    <td><?php echo $apellido1Cita . " " . $apellido2Cita; ?></td>
                </tr>

                <tr>
                    <td><B>Direccion</B></td>
                    <td><?php echo $direccionCita; ?></td>
                    <td><B>Telefono</B></td>
                    <td><?php echo $telefonoCita; ?></td>
                </tr>

                <tr>
                    <td><B>Formula</B></td>
                    <td colspan="3"><?php echo $formulaCita; ?></td>
                </tr>

            </table> 
        </div>

        <center><input type="button" id= "botonPrint" onclick="printDiv('cuerpoPagina')" value="IMPRIMIR CITA MEDICA" /></center>
    </body>
</html>