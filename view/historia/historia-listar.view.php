<!-- Vista para pantalla resultados de la busqueda de historias clinicas con aplicacion de filtros -->
<h6 class="page-header">
    GECOPA - HISTORIAS CLINICAS - Resultados busqueda de historias clinicas 
</h6>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Documento N°</th>
            <th>1er Nombre</th>
            <th class="visible-md visible-lg">2do Nombre</th>
            <th>1er Apellido</th>
            <th class="visible-md visible-lg">2do Apellido</th>
            <th style="width:20px;"></th>
            <th style="width:20px;"></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->modelHistoria->listarConComodin($_REQUEST['filtro'],$_REQUEST['filtroA'],$_REQUEST['filtroB'],$_REQUEST['filtroC'],$_REQUEST['filtroD'],$this->auth->usuario()->medico_id) as $r): ?>
        <tr>
            <td><?php echo $r->historia_cedula; ?></td>
            <td><?php echo $r->historia_nombre_1; ?></td>
            <td class="visible-md visible-lg"><?php echo $r->historia_nombre_2; ?></td>
            <td><?php echo $r->historia_apellido_1; ?></td>
            <td class="visible-md visible-lg"><?php echo $r->historia_apellido_2; ?></td>

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
