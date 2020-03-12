<!-- Vista para CRUD a la base de datos Nuevo registro o modo edicion -->
<h6 class="page-header">
    <?php echo $citaMedica->historia_id != null ? 'GECOPA - Consultar cita medica' : 'GECOPA - Crear nueva cita medica'; ?> <!-- ORGANIZAR -->
</h6>

<ol class="breadcrumb">
  <li><a href="?c=Cita&a=listarCitas&filtro=<?php echo $historiaMedica->historia_cedula;?>&token=<?php echo @$_GET['token']; ?>">Cronologia citas medicas</a></li>
  <li class="active"><?php echo $historiaMedica->historia_id != null ? $historiaMedica->historia_nombre_1 : 'Nueva cita medica'; ?></li> <!-- ORGANIZAR -->
</ol>

<form class="col-md-12" id="frm-cita" action="?c=Cita&a=Guardar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $citaMedica->cita_id; ?>" />
    <input type="hidden" name="idHistoria" value="<?php echo $historiaMedica->historia_id; ?>" />
    <input type="hidden" name="cedulaHistoria" value="<?php echo $historiaMedica->historia_cedula; ?>" /> 

    <?php $citaMedica->cita_id != null ? $citaLectura = '' : $citaLectura = '';?> <!-- readonly Habilita/Deshabilita edicion cita -->

    <div class="container-fluid shadow">
        <div class="row">     
            <div class="row" id="tab0" data-role="tab">
                <!-- Coleccion menu pestañas de TAB -->
                <ul class="nav nav-tabs">
                    <li class="active"><a id="tabLabel1" href="#tabContent1" data-toggle="tab">Cita medica</a></li>
                </ul>

                <div class="tab-content">
                    <!-- TAB Cita medica -->
                    <div class="tab-pane active" id="tabContent1">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="fecha">Fecha de la cita</label>
                                        <input readonly value="<?php echo $citaMedica->cita_fecha; ?>" name="fecha" id="fecha" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="cedula">Documento</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_1">1er Nombre</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_nombre_1; ?>" name="nombre_1" id="nombre_1" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_2">2do Nombre</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_nombre_2; ?>" name="nombre_2" id="nombre_2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_1">1er Apellido</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_apellido_1; ?>" name="apellido_1" id="apellido_1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_2">2do Apellido</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_apellido_2; ?>" name="apellido_2" id="apellido_2" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3 -->                                        
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="direccion">Direccion</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_direccion; ?>" name="direccion" id="direccion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="telefono">Telefono</label>
                                        <input readonly value="<?php echo $historiaMedica->historia_telefono; ?>" name="telefono" id="telefono" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 4-->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="informe">Informe de la visita</label>
                                        <textarea <?php echo $citaLectura;?> onblur="Mayuscula(this);" name="informe" id="informe" type="textarea" class="form-control" placeholder="" rows="10"><?php echo $citaMedica->cita_informe; ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="formula">Formula medica</label>
                                        <textarea <?php echo $citaLectura;?> onblur="Mayuscula(this);" name="formula" id="formula" type="textarea" class="form-control" placeholder="" rows="10"><?php echo $citaMedica->cita_formula; ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>
    </div>

    <hr />
    
    <div class="form-group col-md-12 text-right" style="display: block;">
        <?php if ($citaLectura == '') echo "<button class='btn btn-success' name='btn-guardar' id='btn-guardar'>Guardar cita medica</button>";?>
    </div>

    <!-- Imprimir formula de la cita -->
    <div class="form-group col-md-2 text-left" style="display: block;">
        <a href="view/cita/cita-impresion.view.php?
&idCita=<?php echo $citaMedica->cita_id; ?>
&fechaCita=<?php echo $citaMedica->cita_fecha; ?>
&documentoCita=<?php echo $historiaMedica->historia_cedula; ?>
&nombre1Cita=<?php echo $historiaMedica->historia_nombre_1; ?>
&nombre2Cita=<?php echo $historiaMedica->historia_nombre_2; ?>
&apellido1Cita=<?php echo $historiaMedica->historia_apellido_1; ?>
&apellido2Cita=<?php echo $historiaMedica->historia_apellido_2; ?>
&direccionCita=<?php echo $historiaMedica->historia_direccion; ?>
&telefonoCita=<?php echo $historiaMedica->historia_telefono; ?>
&formulaCita=<?php echo $citaMedica->cita_formula; ?>"
 target="_blank">Vista de impresion</a> |
    </div>
    <!-- FIN Imprimir formula de la cita -->
</form>

<script>
    $(document).ready(function(){
        $("#frm-cita").submit(function(){
            return $(this).validate();
        });

        //Validar alteraciones a valores originales y aviso al usuario de pendiente guardar cambios
        $('#frm-cita').on('input', ':input', function() { 
            var value = $(this).val(); 
            if (value.length > 0){ 
                //$(this).removeClass('lost');
                $(this).addClass('btn-info');
                $('#btn-guardar').addClass('btn-info');
            }
        });
    })

    function Mayuscula(caracter) {
        caracter.value = caracter.value.toUpperCase();
    }
</script>