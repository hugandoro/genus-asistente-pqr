<!-- Vista para CRUD a la base de datos Nuevo registro o modo edicion -->
<h6 class="page-header">
    <?php echo $historiaMedica->historia_id != null ? 'ASISTENTE PQR - Web - CONSULTAR / ACTUALIZAR' : 'ASISTENTE PQR - Web - INGRESAR'; ?> <!-- ORGANIZAR -->
</h6>

<ol class="breadcrumb">
  <li><a href="?c=Historia&token=<?php echo @$_GET['token']; ?>">Listar todas las PQR</a></li>
  <li class="active"><?php echo $historiaMedica->historia_id != null ? $historiaMedica->historia_id : 'Nuevo Registro'; ?></li> <!-- ORGANIZAR -->
</ol>

<form class="col-md-12" id="frm-historia" action="?c=Historia&a=Guardar&token=<?php echo @$_GET['token']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $historiaMedica->historia_id; ?>" />
        
    <div class="container-fluid shadow">
        <div class="row">     
            <div class="row" id="tab0" data-role="tab">
                <!-- Coleccion menu pestañas de TAB -->
                <ul class="nav nav-tabs">
                    <li class="active"><a id="tabLabel1" href="#tabContent1" data-toggle="tab">Ficha de la PQR</a></li>
                </ul>

                <div class="tab-content">
                    <!-- TAB Identificacion -->
                    <div class="tab-pane active" id="tabContent1">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="fecha">ID unico de identificacion PQR</label>
                                        <input onblur="Mayuscula(this);" readonly value="<?php echo $historiaMedica->historia_id; ?>" name="id" id="id" type="text" class="form-control" placeholder="Este codigo se generara automaticamente al guardar...">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="cedula">Cedula / Nit</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="number" class="form-control" placeholder="Solo numeros sin puntos o comas">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_1">Primer nombre</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_1; ?>" name="nombre_1" id="nombre_1" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_2">Segundo nombre</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_2; ?>" name="nombre_2" id="nombre_2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_1">Primer apellido</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_1; ?>" name="apellido_1" id="apellido_1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_2">Segundo apellido</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_2; ?>" name="apellido_2" id="apellido_2" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3 -->                                        
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="direccion">Direccion</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_direccion; ?>" name="direccion" id="direccion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="entidad">Barrio/Conjunto/Entidad/Empresa</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="entidad" id="entidad" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="telefono">Telefono</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="telefono" id="telefono" type="number" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="email">Email</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="email" id="email" type="email" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-12 text-right" style="display: block;">
        <button class="btn btn-success" name="btn-guardar" id="btn-guardar">Guardar cambios en la historia</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-historia").submit(function(){
            return $(this).validate();
        });

        //Validar alteraciones a valores originales y aviso al usuario de pendiente guardar cambios
        $('#frm-historia').on('input', ':input', function() { 
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