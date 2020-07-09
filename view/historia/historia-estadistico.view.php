<!-- CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->
<?php 
    $filtro = $_GET["filtro"]; 
    $fechaInicio = $_POST["fecha_inicial"]; 
    $fechaFin = $_POST["fecha_final"]; 

    // Contadores de PQRs discriminadas por estado actual
    $pqrAbiertas = 0;
    $pqrCerradas = 0;
    $pqrTodas = 0;

    $pqrClasificacionConcepto = 0;
    $pqrClasificacionLicencia = 0;
    $pqrClasificacionOrgano = 0;
    $pqrClasificacionAutoridad = 0;
    $pqrClasificacionInformacion = 0;
    $pqrClasificacionGeneral = 0;
    $pqrClasificacionConsulta = 0;
    $pqrClasificacionQueja = 0;
    $pqrClasificacionTutela = 0;
    $pqrClasificacionNC = 0;

    $pqrClasePeticion = 0;
    $pqrClaseQueja = 0;
    $pqrClaseReclamo = 0;
    $pqrClaseDenuncia = 0;
    $pqrClaseSugerencia = 0;
    $pqrClaseFelicitacion = 0;

    $pqrCanalEmail = 0;
    $pqrCanalMensajeria = 0;
    $pqrCanalWeb = 0;
    $pqrCanalTelefono = 0;
    $pqrCanalVentanilla = 0;


    // Recorrido de todos los registros para clasificar y mover los contadores segun estado de las PQR
    foreach($this->modelHistoria->Listar($this->auth->usuario()->medico_id,$this->auth->usuario()->medico_nivel,$this->auth->usuario()->medico_dependencia_codigo) as $r): 

        //Valida que este en el rango de fechas establecido por el usuario
        if ((strtotime($r->historia_radicado_gestion) >= strtotime($fechaInicio)) && (strtotime($r->historia_radicado_gestion) <= strtotime($fechaFin)))
        {
            // Calculo fecha de vencimiento -->
            $sumarDias = $r->historia_dias; //Dias que se establecieron como plazo para responder
            $fechaVencimiento = $this->modelHistoria->sumasDiaSemana($r->historia_radicado_gestion,$sumarDias);

            $fechaActual= date("Y/m/d");
            $diasRestantes = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaActual);
            // Fin calculo fechas de vencimiento

            $pqrTodas++;
                    
            if ($r->historia_fecha_respuesta == NULL)
                $pqrAbiertas++;
            else
                $pqrCerradas++;


            switch ($r->historia_clasificacion_pqr) 
            {
                case "CONCEPTO":
                    $pqrClasificacionConcepto ++;
                    break;
                case "LICENCIA":
                    $pqrClasificacionLicencia ++;
                    break;
                case "ORGANO_CONTROL":
                    $pqrClasificacionOrgano ++;
                    break;
                case "PETICION_AUTORIDAD":
                    $pqrClasificacionAutoridad ++;
                    break;
                case "PETICION_INFORMACION":
                    $pqrClasificacionInformacion ++;
                    break;
                case "PETICION_GENERAL":
                    $pqrClasificacionGeneral ++;
                    break;    
                case "PETICION_CONSULTA":
                    $pqrClasificacionConsulta ++;
                    break;
                case "QUEJA":
                    $pqrClasificacionQueja ++;
                    break;
                case "TUTELA":
                    $pqrClasificacionTutela ++;
                    break;
                case "NO_CLASIFICADA":
                    $pqrClasificacionNC ++;
                    break;  
            }


            switch ($r->historia_clase_pqr) 
            {
                case "PETICION":
                    $pqrClasePeticion ++;
                    break;
                case "QUEJA":
                    $pqrClaseQueja ++;
                    break;
                case "RECLAMO":
                    $pqrClaseReclamo ++;
                    break;
                case "DENUNCIA":
                    $pqrClaseDenuncia ++;
                    break;
                case "SUGERENCIA":
                    $pqrClaseSugerencia ++;
                    break;
                case "FELICITACION":
                    $pqrClaseFelicitacion ++;
                    break;    
            }


            switch ($r->historia_canal) 
            {
                case "EMAIL":
                    $pqrCanalEmail ++;
                    break;
                case "MENSAJERIA":
                    $pqrCanalMensajeria ++;
                    break;
                case "WEB":
                    $pqrCanalWeb ++;
                    break;
                case "TELEFONO":
                    $pqrCanalTelefono ++;
                    break;
                case "VENTANILLA":
                    $pqrCanalVentanilla ++;
                    break;
            }

        }       
    endforeach;
?>
<!-- *** FIN CALCULO PARA ESTADISTICOS - Cabezera de pagina - botones -->


<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    ASISTENTE PQR - Consolidado estadistico 
</h6>


<form action="?c=Historia&a=estadistico&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-4" style="display: block;">
        <label>Fecha Inicial</label>
        <input name="fecha_inicial" id="fecha_inicial" type="date" class="form-control" placeholder="" value="<?php echo $fechaInicio; ?>">
    </div>
    <div class="form-group col-md-4" style="display: block;">
        <label>Fecha Final</label>
        <input name="fecha_final" id="fecha_final" type="date" class="form-control" placeholder="" value="<?php echo $fechaFin; ?>">
    </div>
    <div class="form-group col-md-4" style="display: block;">
        <br><button class="btn btn-success btn-lg" name="btn-filtrar" id="btn-filtrar">Generar Estadisticas</button>
    </div>
</form>


<h3><b>N° de PQR recepcionadas y estado de las mismas</b></h3>
<div class="form-group col-md-12">
    <table>
        <tr>
            <td>PQR Abiertas </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrAbiertas; ?></b></h4></td>
        </tr>
        <tr>
            <td>PQR Cerradas </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCerradas; ?></td>
        </tr>
    </table>
</div>
                                                                                              

<h3><b>Clasificacion de las PQR</b></h3>
<div class="form-group col-md-12">
    <table>
        <tr>
            <td>Concepto sobre traslado de poste </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionConcepto; ?></b></h4></td>
        </tr>
        <tr>
            <td>Licencia de intervención y ocupación de espacio público </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionLicencia; ?></b></h4></td>
        </tr>
        <tr>
            <td>Órgano de control, pólitico, disciplinario, fiscal, jurisdiccional, ciudadano </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionOrgano; ?></b></h4></td>
        </tr>
        <tr>
            <td>Petición entre autoridades </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionAutoridad; ?></b></h4></td>
        </tr>
        <tr>
            <td>Petición de información y documentos </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionInformacion; ?></b></h4></td>
        </tr>
        <tr>
            <td>Petición de interese general o particular </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionGeneral; ?></td>
        </tr>
        <tr>
            <td>Petición de consulta </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionConsulta; ?></td>
        </tr>
        <tr>
            <td>Queja, reclamo y manifestación </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionQueja; ?></td>
        </tr>
        <tr>
            <td>Tutela </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionTutela; ?></td>
        </tr>
        <tr>
            <td>No clasificada </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasificacionNC; ?></td>
        </tr>
    </table>
</div>


<h3><b>Clase de PQR</b></h3>
<div class="form-group col-md-12">
    <table>
        <tr>
            <td>Peticiones </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClasePeticion; ?></b></h4></td>
        </tr>
        <tr>
            <td>Quejas </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClaseQueja; ?></b></h4></td>
        </tr>
        <tr>
            <td>Reclamos </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClaseReclamo; ?></b></h4></td>
        </tr>
        <tr>
            <td>Denuncias </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClaseDenuncia; ?></b></h4></td>
        </tr>
        <tr>
            <td>Sugerencias </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClaseSugerencia; ?></b></h4></td>
        </tr>
        <tr>
            <td>Felicitaciones </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrClaseFelicitacion; ?></td>
        </tr>
    </table>
</div>


<h3><b>Via de recepcion de las PQR (Canales)</b></h3>
<div class="form-group col-md-12">
    <table>
        <tr>
            <td>Email </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCanalEmail; ?></b></h4></td>
        </tr>
        <tr>
            <td>Mensajeria </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCanalMensajeria; ?></b></h4></td>
        </tr>
        <tr>
            <td>Web </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCanalWeb; ?></b></h4></td>
        </tr>
        <tr>
            <td>Telefono </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCanalTelefono; ?></b></h4></td>
        </tr>
        <tr>
            <td>Ventanilla </td>
            <td><h4><b>&nbsp;&nbsp;&nbsp;<?php echo $pqrCanalVentanilla; ?></b></h4></td>
        </tr>
    </table>
</div>





