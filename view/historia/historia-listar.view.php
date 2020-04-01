<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    ASISTENTE PQR - Web 
</h6>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>CC/Nit</th>
            <th>1er Nombre</th>
            <th>1er Apellido</th>
            <th>Clase</th>
            <th>Canal</th>
            <th>Estado</th>
            <th>Dias restantes</th>
            <th>Estado</th>
            <th style="width:20px;"></th>
            <th style="width:20px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->modelHistoria->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->historia_id; ?></td>
            <td><?php echo $r->historia_cedula; ?></td>
            <td><?php echo $r->historia_nombre_1; ?></td>
            <td><?php echo $r->historia_apellido_1; ?></td>
            <td><?php echo $r->historia_clase_pqr; ?></td>
            <td><?php echo $r->historia_canal; ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo "Abierta"; else echo "Cerrada" ?></td>
            <td><?php if($r->historia_fecha_respuesta == NULL) echo "15"; else echo "-" ?></td></td>
            
            <td><img src="assets/img/verde.png" width=16px title="Semaforo PQR"></td>

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
