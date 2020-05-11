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
                    <li class="active"><a id="tabLabel1" href="#tabContent1" data-toggle="tab">Datos generales de la PQR</a></li>
                    <li><a id="tabLabel2" href="#tabContent2" data-toggle="tab">Recepcion y Asignacion</a></li>
                    <li><a id="tabLabel3" href="#tabContent3" data-toggle="tab">Tiempos y cierre de la PQR</a></li>
                </ul>

                <div class="tab-content">
                    <!-- TAB Datos Generales -->
                    <div class="tab-pane active" id="tabContent1">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br><br>
                                    <?php if ($this->auth->usuario()->medico_nivel == '2') $aux = 'readonly '; else $aux = ''; ?>

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="fecha">ID PQR</label>
                                        <input onblur="Mayuscula(this);" readonly value="<?php echo $historiaMedica->historia_id; ?>" name="id" id="id" type="text" class="form-control" placeholder="N° automatico...">
                                    </div>

                                    <div class="form-group col-md-8" style="display: block;">
                                        <label for="clasificacion_pqr">Clasificacion de la PQR</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_clasificacion_pqr; ?>" name="clasificacion_pqr" id="clasificacion_pqr" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>
                                            <select name="clasificacion_pqr" id="clasificacion_pqr" class="form-control">                                                                                       
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "CONCEPTO") echo 'selected' ?> value="CONCEPTO">CONCEPTOS SOBRE TRASLADOS DE POSTE - 30 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "LICENCIA") echo 'selected' ?> value="LICENCIA">LICENCIAS DE INTERVENCIÓN Y OCUPACIÓN DE ESPACIO PÚBLICO - 45 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "ORGANO_CONTROL") echo 'selected' ?> value="ORGANO_CONTROL">ÓRGANOS DE CONTROL, POLÍTICO, DISCIPLINARIO, FISCAL, JURISDICCIONAL, CIUDADANO - 5 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_AUTORIDAD") echo 'selected' ?> value="PETICION_AUTORIDAD">PETICIONES ENTRE AUTORIDADES - 10 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_INFORMACION") echo 'selected' ?> value="PETICION_INFORMACION">PETICIONES DE INFORMACIÓN Y DOCUMENTOS - 10 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_GENERAL") echo 'selected' ?> value="PETICION_GENERAL">PETICIONES DE INTERÉS GENERAL O PARTICULAR - 15 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_CONSULTA") echo 'selected' ?> value="PETICION_CONSULTA">PETICIONES DE CONSULTA - 30 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "QUEJA") echo 'selected' ?> value="QUEJA">QUEJAS, RECLAMOS Y MANIFESTACIONES - 15 dias</option>                           
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="cedula">Cedula / Nit</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="number" class="form-control" placeholder="Solo numeros sin puntos o comas">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_1">Primer nombre</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_1; ?>" name="nombre_1" id="nombre_1" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="nombre_2">Segundo nombre</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_2; ?>" name="nombre_2" id="nombre_2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_1">Primer apellido</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_1; ?>" name="apellido_1" id="apellido_1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="apellido_2">Segundo apellido</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_2; ?>" name="apellido_2" id="apellido_2" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <!-- Fila 3 -->                                        
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="direccion">Direccion</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_direccion; ?>" name="direccion" id="direccion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="entidad">Barrio/Conjunto/Entidad/Empresa</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_entidad; ?>" name="entidad" id="entidad" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="cargo">Cargo/Funcion</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_cargo; ?>" name="cargo" id="cargo" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>
                                            <select name="cargo" id="cargo" class="form-control">
                                                <option <?php if ($historiaMedica->historia_cargo == "ADMINISTRADOR") echo 'selected' ?> value="ADMINISTRADOR">ADMINISTRADOR</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "CONCEJAL") echo 'selected' ?> value="CONCEJAL">CONCEJAL</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "COORDINADOR") echo 'selected' ?> value="COORDINADOR">COORDINADOR</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "DIRECTOR") echo 'selected' ?> value="DIRECTOR">DIRECTOR</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "GERENTE") echo 'selected' ?> value="GERENTE">GERENTE</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "PETICIONARIO") echo 'selected' ?> value="PETICIONARIO">PETICIONARIO</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "PRESIDENTE") echo 'selected' ?> value="PRESIDENTE">PRESIDENTE</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "REPRESENTANTE_LEGAL") echo 'selected' ?> value="REPRESENTANTE_LEGAL">REPRESENTANTE LEGAL</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <!-- Fila 4 --> 
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="telefono">Telefono</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="telefono" id="telefono" type="number" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="email">Email</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_email; ?>" name="email" id="email" type="email" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB Recepcion y asignacion -->
                    <div class="tab-pane" id="tabContent2">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br><br>

                                    <!-- Fila 1 --> 
                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="tipo_usuario">Tipo usuario</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_tipo_usuario; ?>" name="tipo_usuario" id="tipo_usuario" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                                                <option <?php if ($historiaMedica->historia_tipo_usuario == "INTERNO") echo 'selected' ?> value="INTERNO">INTERNO</option>
                                                <option <?php if ($historiaMedica->historia_tipo_usuario == "EXTERNO") echo 'selected' ?> value="EXTERNO">EXTERNO</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="clase_pqr">Naturaleza de la PQR</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_clase_pqr; ?>" name="clase_pqr" id="clase_pqr" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="clase_pqr" id="clase_pqr" class="form-control">
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "PETICION") echo 'selected' ?> value="PETICION">PETICION</option>
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "QUEJA") echo 'selected' ?> value="QUEJA">QUEJA</option>
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "RECLAMO") echo 'selected' ?> value="RECLAMO">RECLAMO</option>
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "DENUNCIA") echo 'selected' ?> value="DENUNCIA">DENUNCIA</option>
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "SUGERENCIA") echo 'selected' ?> value="SUGERENCIA">SUGERENCIA</option>
                                                <option <?php if ($historiaMedica->historia_clase_pqr == "FELICITACION") echo 'selected' ?> value="FELICITACION">FELICITACION</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="canal">Canal receptor</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_canal; ?>" name="canal" id="canal" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="canal" id="canal" class="form-control">
                                                <option <?php if ($historiaMedica->historia_canal == "CORREO_EMAIL") echo 'selected' ?> value="CORREO_EMAIL">CORREO ELECTRONICO</option>
                                                <option <?php if ($historiaMedica->historia_canal == "CORREO_INTERNO") echo 'selected' ?> value="CORREO_INTERNO">CORREO INTERNO</option>
                                                <option <?php if ($historiaMedica->historia_canal == "WEB") echo 'selected' ?> value="WEB">PAGINA WEB</option>
                                                <option <?php if ($historiaMedica->historia_canal == "VENTANILLA") echo 'selected' ?> value="VENTANILLA">VENTANILLA UNICA</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <!-- Fila 2 --> 
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="radicado_gestion">Radicado gestion documental</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_radicado_gestion; ?>" name="radicado_gestion" id="radicado_gestion" type="date" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="num_radicado_gestion">N° Rad.</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_radicado_gestion; ?>" name="num_radicado_gestion" id="num_radicado_gestion" type="number" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="radicado_planeacion">Radicado planeacion</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_radicado_planeacion; ?>" name="radicado_planeacion" id="radicado_planeacion" type="date" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="num_radicado_planeacion">N° Rad.</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_radicado_planeacion; ?>" name="num_radicado_planeacion" id="num_radicado_planeacion" type="number" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 3 --> 
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="area">Area a quien se le asigna</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_area; ?>" name="area" id="area" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="area" id="area" class="form-control">
                                                <option <?php if ($historiaMedica->historia_area == "POT") echo 'selected' ?> value="POT">POT</option>
                                                <option <?php if ($historiaMedica->historia_area == "SOCIOECONOMICA") echo 'selected' ?> value="SOCIOECONOMICA">SOCIOECONOMICA</option>
                                                <option <?php if ($historiaMedica->historia_area == "CALIDAD") echo 'selected' ?> value="CALIDAD">CALIDAD</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="funcionario">Funcionario asignado</label>

                                        <?php if ($this->auth->usuario()->medico_nivel == '2') { ?>
                                            <!-- El input oculto 'Hidden' carga el codigo y vuelve y lo envia al guardar -->
                                            <input type="hidden" value="<?php echo $historiaMedica->historia_funcionario; ?>" name="funcionario" id="funcionario" class="form-control">
                                            <!-- El input visible solo muestra el nombre del usuario pero NO se utiliza para ser guardado, 
                                            se asume que si el usuario esta viendo este registro el nombre corresponde al obtenido mediante Auth-->
                                            <input readonly value="<?php echo $this->auth->usuario()->medico_nombres; ?> <?php echo $this->auth->usuario()->medico_apellidos; ?>" name="funcionarioVisible" id="funcionarioVisible" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                                                                                       
                                            <select name="funcionario" id="funcionario" class="form-control">
                                                <?php foreach($this->modelMedico->listarUsuarios() as $r): ?>
                                                    <option <?php if ($historiaMedica->historia_funcionario == $r->medico_id) echo 'selected' ?> value=<?php echo $r->medico_id; ?>><?php echo $r->medico_nombres; ?> <?php echo $r->medico_apellidos; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php }?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                   <!-- TAB Tiempo y cierre -->
                   <div class="tab-pane" id="tabContent3">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <br><br>

                                    <!-- Fila 1 --> 
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="medio_respuesta">Medio de respuesta</label>

                                        <select name="medio_respuesta" id="medio_respuesta" class="form-control">
                                            <option <?php if ($historiaMedica->historia_medio_respuesta == "CORREO_EMAIL") echo 'selected' ?> value="CORREO_EMAIL">CORREO ELECTRONICO</option>
                                            <option <?php if ($historiaMedica->historia_medio_respuesta == "OFICIO") echo 'selected' ?> value="OFICIO">OFICIO</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="fecha_respuesta">Fecha de respuesta</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fecha_respuesta; ?>" name="fecha_respuesta" id="fecha_respuesta" type="date" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="num_oficio_respuesta">N° de oficio</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_oficio_respuesta; ?>" name="num_oficio_respuesta" id="num_oficio_respuesta" type="number" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="estado_respuesta">Estado de la respuesta</label><br>
                                        <!-- Calculo fecha de vencimiento -->
                                        <?php
                                            if ($historiaMedica->historia_clasificacion_pqr == 'CONCEPTO') $sumarDias = 30;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'LICENCIA') $sumarDias = 45;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'ORGANO_CONTROL') $sumarDias = 5;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'PETICION_AUTORIDAD') $sumarDias = 10;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'PETICION_INFORMACION') $sumarDias = 10;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'PETICION_GENERAL') $sumarDias = 15;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'PETICION_CONSULTA') $sumarDias = 30;
                                            if ($historiaMedica->historia_clasificacion_pqr == 'QUEJA') $sumarDias = 15;
                                            $fechaVencimiento = $this->modelHistoria->sumasDiaSemana($historiaMedica->historia_radicado_gestion,$sumarDias);

                                            $fechaRespuesta = $historiaMedica->historia_fecha_respuesta;
                                            $diasRestantes = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaRespuesta);

                                            $fechaActual= date("Y/m/d");
                                            $diasCorridos = $this->modelHistoria->diasPasados($fechaVencimiento,$fechaActual);

                                            if (($diasRestantes >= 0) && ($historiaMedica->historia_fecha_respuesta != NULL)) echo "Dentro de los terminos";
                                            if (($diasRestantes < 0) && ($historiaMedica->historia_fecha_respuesta != NULL)) echo "Fuera de los terminos";
                                            if (($historiaMedica->historia_fecha_respuesta == NULL) && ($diasCorridos < 0)) echo "<b>$diasCorridos</b> dias calendario vencida";
                                            if (($historiaMedica->historia_fecha_respuesta == NULL) && ($diasCorridos >= 0)) echo "<b>$diasCorridos</b> dias calendario para vencer";


                                        ?>
                                        <!-- Fin calculo fechas de vencimiento -->
                                    </div>

                                    <!-- Fila 2 --> 
                                    <div class="form-group col-md-12" style="display: block;">
                                        <label for="respuesta">Breve descripcion de la respuesta</label>
                                        <input onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_respuesta; ?>" name="respuesta" id="respuesta" type="text" class="form-control" placeholder="">
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
        <br>
        <button class="btn btn-success btn-block" name="btn-guardar" id="btn-guardar">Guardar cambios en la historia</button>
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