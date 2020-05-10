<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    ASISTENTE PQR - Web 
</h6>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Cod</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Clase</th>
            <th>Clasificacion</th>
            <th>Estado</th>
            <th>Radicado gestion</th>
            <th>Vencimiento</th>
            <th>Dias</th>
            <th>Estado</th>
            <th style="width:20px;"></th>
            <th style="width:20px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->modelHistoria->Listar($this->auth->usuario()->medico_id,$this->auth->usuario()->medico_nivel) as $r): ?>

        <!-- Calculo fecha de vencimiento -->
        <?php
            if ($r->historia_clasificacion_pqr == 'CONCEPTO') $sumarDias = 30;
            if ($r->historia_clasificacion_pqr == 'LICENCIA') $sumarDias = 45;
            if ($r->historia_clasificacion_pqr == 'ORGANO_CONTROL') $sumarDias = 5;
            if ($r->historia_clasificacion_pqr == 'PETICION_AUTORIDAD') $sumarDias = 10;
            if ($r->historia_clasificacion_pqr == 'PETICION_INFORMACION') $sumarDias = 10;
            if ($r->historia_clasificacion_pqr == 'PETICION_GENERAL') $sumarDias = 15;
            if ($r->historia_clasificacion_pqr == 'PETICION_CONSULTA') $sumarDias = 30;
            if ($r->historia_clasificacion_pqr == 'QUEJA') $sumarDias = 15;
            $fechaVencimiento = $this->modelHistoria->sumasDiaSemana($r->historia_radicado_gestion,$sumarDias);

            $fechaActual= date("Y/m/d");
            $diasRestantes = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaActual);

            if ($diasRestantes > 5) $imagenSemaforo = 'assets/img/verde.png';
            if ($diasRestantes <= 5) $imagenSemaforo = 'assets/img/amarillo.png';
            if ($diasRestantes < 1) $imagenSemaforo = 'assets/img/rojo.png';

        ?>
        <!-- Fin calculo fechas de vencimiento -->

        <tr>
            <td><?php echo $r->historia_id; ?></td>
            <td><?php echo $r->historia_nombre_1; ?></td>
            <td><?php echo $r->historia_apellido_1; ?></td>
            <td><?php echo $r->historia_clase_pqr; ?></td>
            <td><?php echo $r->historia_clasificacion_pqr; ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo "Abierta"; else echo "Cerrada" ?></td>
            <td><?php echo $r->historia_radicado_gestion; ?></td>
            <td><?php echo $fechaVencimiento; ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo $diasRestantes; else echo "-" ?></td></td>

            <td>
                <?php if($r->historia_fecha_respuesta == NULL) echo "<img src='$imagenSemaforo' width=16px title='Semaforo PQR'>" ; else echo "-" ?>
            </td>

            <td>
                <a href="?c=Historia&a=Crud&id=<?php echo $r->historia_id; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/abrir.png" width=16px title="Abrir historia"></a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar esta historia ? tenga presente que con esta accion tambien seran eliminadas las citas relacionadas con la historia medica...');" href="?c=Historia&a=Eliminar&id=<?php echo $r->historia_id; ?>&filtro=<?php echo $_REQUEST['filtro']; ?>&token=<?php echo @$_GET['token']; ?>"><img src="assets/img/eliminar.png" width=16px title="Eliminar historia"></a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
