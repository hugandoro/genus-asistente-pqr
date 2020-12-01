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
                                    <!-- Deshabilita campor para usuarios nivel USUARIO '2' o AUDITOR '0' -->
                                    <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) $aux = 'readonly '; else $aux = ''; ?> 

                                    <!-- Fila 1 -->
                                    <div class="form-group col-md-1" style="display: block;">
                                        <label for="fecha">ID PQR</label>
                                        <input onblur="Mayuscula(this);" readonly value="<?php echo $historiaMedica->historia_id; ?>" name="id" id="id" type="text" class="form-control" placeholder="N° automatico...">
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="clasificacion_pqr">Clasificacion de la PQR</label>

                                        <?php if (($this->auth->usuario()->medico_nivel == '2')  || ($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_clasificacion_pqr; ?>" name="clasificacion_pqr" id="clasificacion_pqr" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>
                                            <select name="clasificacion_pqr" id="clasificacion_pqr" class="form-control">                                                                                       
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "CONCEPTO") echo 'selected' ?> value="CONCEPTO">Concepto sobre traslado de poste - 30 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "ESTRATIFICACION") echo 'selected' ?> value="ESTRATIFICACION">Estratificacion - 15 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "LICENCIA") echo 'selected' ?> value="LICENCIA">Licencia de intervención y ocupación de espacio público - 45 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "NOMENCLATURA") echo 'selected' ?> value="NOMENCLATURA">Nomenclatura - 15 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "ORGANO_CONTROL") echo 'selected' ?> value="ORGANO_CONTROL">Órgano de control, pólitico, disciplinario, fiscal, jurisdiccional, ciudadano - 5 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_AUTORIDAD") echo 'selected' ?> value="PETICION_AUTORIDAD">Petición entre autoridades - 10 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_INFORMACION") echo 'selected' ?> value="PETICION_INFORMACION">Petición de información y documentos - 10 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_GENERAL") echo 'selected' ?> value="PETICION_GENERAL">Petición de interese general o particular - 15 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PETICION_CONSULTA") echo 'selected' ?> value="PETICION_CONSULTA">Petición de consulta - 30 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "PLANOS") echo 'selected' ?> value="PLANOS">Planos - 15 dias</option>
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "QUEJA") echo 'selected' ?> value="QUEJA">Queja, reclamo y manifestación - 15 dias</option>  
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "APELACION_REPOSICION") echo 'selected' ?> value="APELACION_REPOSICION">Recursos de apelacion y reposición - 60 dias</option>         
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "TUTELA") echo 'selected' ?> value="TUTELA">Tutela - 2 dias</option>         
                                                <option <?php if ($historiaMedica->historia_clasificacion_pqr == "NO_CLASIFICADA") echo 'selected' ?> value="NO_CLASIFICADA">No clasificada</option>                                                                                               
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-5" style="display: block;">
                                        <img src='assets/img/alarma.png' width=20px title='Semaforo PQR'><label for="dias">&nbsp;&nbsp;Dias Habiles (Dejar en blanco para valores predefinidos)</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_dias; ?>" name="dias" id="dias" type="number" class="form-control" placeholder="Dejar en blanco para valores predefinidos...">
                                    </div>

                                    <!-- Fila 2 -->
                                    <div class="form-group col-md-12" style="display: block;">
                                        <label for="asunto">Asunto - Descripción breve</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_asunto; ?>" name="asunto" id="asunto" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 3 -->
                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="cedula">Cedula / Nit</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_cedula; ?>" name="cedula" id="cedula" type="number" class="form-control" placeholder="Solo numeros sin puntos o comas">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="nombre_1">Primer nombre</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_1; ?>" name="nombre_1" id="nombre_1" type="text" class="form-control" placeholder="" >
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="nombre_2">Segundo nombre</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_nombre_2; ?>" name="nombre_2" id="nombre_2" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="apellido_1">Primer apellido</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_1; ?>" name="apellido_1" id="apellido_1" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="apellido_2">Segundo apellido</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_apellido_2; ?>" name="apellido_2" id="apellido_2" type="text" class="form-control" placeholder="">
                                    </div>
    
                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="telefono">Telefono</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_telefono; ?>" name="telefono" id="telefono" type="number" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 4 -->                                        
                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="direccion">Direccion</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_direccion; ?>" name="direccion" id="direccion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="entidad">Barrio/Conjunto/Entidad/Empresa</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_entidad; ?>" name="entidad" id="entidad" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="cargo">Cargo/Funcion</label>

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_cargo; ?>" name="cargo" id="cargo" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>
                                            <select name="cargo" id="cargo" class="form-control">
                                                <option <?php if ($historiaMedica->historia_cargo == "Administrador") echo 'selected' ?> value="Administrador">Administrador(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Alcalde") echo 'selected' ?> value="Alcalde">Alcalde(sa)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Asesor") echo 'selected' ?> value="Asesor">Asesor(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Concejal") echo 'selected' ?> value="Concejal">Concejal</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Contralor") echo 'selected' ?> value="Contralor">Contralor(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Coordinador") echo 'selected' ?> value="Coordinador">Coordinador(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Curador") echo 'selected' ?> value="Curador">Curador(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Director") echo 'selected' ?> value="Director">Director(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Gerente") echo 'selected' ?> value="Gerente">Gerente</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Jefe de area") echo 'selected' ?> value="Jefe de area">Jefe de área</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Juez") echo 'selected' ?> value="Juez">Juez</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Personero") echo 'selected' ?> value="Personero">Personero(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Peticionario") echo 'selected' ?> value="Peticionario">Peticionario(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Presidente") echo 'selected' ?> value="Presidente">Presidente</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Procurador") echo 'selected' ?> value="Procurador">Procurador(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Representante Legal") echo 'selected' ?> value="Representante Legal">Representante Legal</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Secretario") echo 'selected' ?> value="Secretario">Secretario(a)</option>
                                                <option <?php if ($historiaMedica->historia_cargo == "Subdirector") echo 'selected' ?> value="Subdirector">Subdirector(a)</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
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

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
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

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
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

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_canal; ?>" name="canal" id="canal" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="canal" id="canal" class="form-control">
                                                <option <?php if ($historiaMedica->historia_canal == "EMAIL") echo 'selected' ?> value="EMAIL">EMAIL</option>
                                                <option <?php if ($historiaMedica->historia_canal == "MENSAJERIA") echo 'selected' ?> value="MENSAJERIA">MENSAJERIA INTERNA</option>
                                                <option <?php if ($historiaMedica->historia_canal == "WEB") echo 'selected' ?> value="WEB">PAGINA WEB</option>
                                                <option <?php if ($historiaMedica->historia_canal == "TELEFONO") echo 'selected' ?> value="TELEFONO">TELEFONO</option>
                                                <option <?php if ($historiaMedica->historia_canal == "VENTANILLA") echo 'selected' ?> value="VENTANILLA">VENTANILLA UNICA</option>
                                                <option <?php if ($historiaMedica->historia_canal == "GOBEL") echo 'selected' ?> value="GOBEL">GOBEL</option>
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
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_radicado_gestion; ?>" name="num_radicado_gestion" id="num_radicado_gestion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="radicado_planeacion">Radicado planeacion</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_radicado_planeacion; ?>" name="radicado_planeacion" id="radicado_planeacion" type="date" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="num_radicado_planeacion">N° Rad.</label>
                                        <input <?php echo $aux; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_radicado_planeacion; ?>" name="num_radicado_planeacion" id="num_radicado_planeacion" type="text" class="form-control" placeholder="">
                                    </div>

                                    <!-- Fila 3 --> 
                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="area">Area a quien se le asigna</label>

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_area; ?>" name="area" id="area" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                        
                                            <select name="area" id="area" class="form-control">
                                                <option <?php if ($historiaMedica->historia_area == "DSP1") echo 'selected' ?> value="DSP1">Despacho Secretaria - Despacho</option>
                                                <option <?php if ($historiaMedica->historia_area == "DSP2") echo 'selected' ?> value="DSP2">Despacho Secretaria - Juridica</option>

                                                <option <?php if ($historiaMedica->historia_area == "DAS1") echo 'selected' ?> value="DAS1">Direccion de Asuntos Socioeconomicos - Banco de Proyectos</option>
                                                <option <?php if ($historiaMedica->historia_area == "DAS2") echo 'selected' ?> value="DAS2">Direccion de Asuntos Socioeconomicos - Desarrollo Socioeconomico</option>
                                                <option <?php if ($historiaMedica->historia_area == "DAS3") echo 'selected' ?> value="DAS3">Direccion de Asuntos Socioeconomicos - Presupuesto Participativo</option>
                                                <option <?php if ($historiaMedica->historia_area == "DAS4") echo 'selected' ?> value="DAS4">Direccion de Asuntos Socioeconomicos - Sisben</option>

                                                <option <?php if ($historiaMedica->historia_area == "DOT1") echo 'selected' ?> value="DOT1">Direccion de Ordenamiento Territorial - Estratificacion</option>
                                                <option <?php if ($historiaMedica->historia_area == "DOT2") echo 'selected' ?> value="DOT2">Direccion de Ordenamiento Territorial - Licencias de intervencion y ocupacion espacio publico</option>
                                                <option <?php if ($historiaMedica->historia_area == "DOT3") echo 'selected' ?> value="DOT3">Direccion de Ordenamiento Territorial - Nomenclatura</option>
                                                <option <?php if ($historiaMedica->historia_area == "DOT4") echo 'selected' ?> value="DOT4">Direccion de Ordenamiento Territorial - Ordenamiento Territorial</option>
                                                <option <?php if ($historiaMedica->historia_area == "DOT5") echo 'selected' ?> value="DOT5">Direccion de Ordenamiento Territorial - Propiedad Horizontal</option>
                                                <option <?php if ($historiaMedica->historia_area == "DOT6") echo 'selected' ?> value="DOT6">Direccion de Ordenamiento Territorial - Servicios Publicos</option>

                                                <option <?php if ($historiaMedica->historia_area == "DSG1") echo 'selected' ?> value="DSG1">Direccion de Sistemas de Gestion - Sistemas de Gestion</option>

                                                <option <?php if ($historiaMedica->historia_area == "INF1") echo 'selected' ?> value="INF1">Informativas - Informativas</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-6" style="display: block;">
                                        <label for="funcionario">Funcionario asignado</label>

                                        <?php if (($this->auth->usuario()->medico_nivel == '2') || ($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <!-- El input oculto 'Hidden' carga el codigo y vuelve y lo envia al guardar -->
                                            <input type="hidden" value="<?php echo $historiaMedica->historia_funcionario; ?>" name="funcionario" id="funcionario" class="form-control">
                                            
                                            <!-- El input visible solo muestra el nombre del usuario pero NO se utiliza para ser guardado, 
                                            se asume que si el usuario esta viendo este registro el nombre corresponde al obtenido mediante Auth-->
                                            <!-- ATENCION !!! - VALIDAR UN ERROR DE NOMBRE VISIBLE PARA USUARIO AUDITORIES -->
                                            <input readonly value="<?php echo $this->auth->usuario()->medico_nombres; ?> <?php echo $this->auth->usuario()->medico_apellidos; ?>" name="funcionarioVisible" id="funcionarioVisible" class="form-control">
                                        <?php }?>

                                        <?php if ($this->auth->usuario()->medico_nivel == '1') { ?>                                                                                                       
                                            <select name="funcionario" id="funcionario" class="form-control">
                                                <?php foreach($this->modelMedico->listarUsuarios() as $r): ?>

                                                    <?php if ($r->medico_nivel == 2){?>
                                                        <option <?php if ($historiaMedica->historia_funcionario == $r->medico_id) echo 'selected' ?> value=<?php echo $r->medico_id; ?>><?php echo $r->medico_dependencia; ?> | <?php echo $r->medico_nombres; ?> <?php echo $r->medico_apellidos; ?></option>
                                                    <?php } ?>

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

                                        <?php if (($this->auth->usuario()->medico_nivel == '0')) { ?>
                                            <input readonly value="<?php echo $historiaMedica->historia_medio_respuesta; ?>" name="medio_respuesta" id="medio_respuesta" class="form-control">
                                        <?php }?>

                                        <?php if (($this->auth->usuario()->medico_nivel == '1') || ($this->auth->usuario()->medico_nivel == '2')) { ?>                                        
                                            <select name="medio_respuesta" id="medio_respuesta" class="form-control">
                                                <option <?php if ($historiaMedica->historia_medio_respuesta == "CORREO_EMAIL") echo 'selected' ?> value="CORREO_EMAIL">CORREO ELECTRONICO</option>
                                                <option <?php if ($historiaMedica->historia_medio_respuesta == "OFICIO") echo 'selected' ?> value="OFICIO">OFICIO</option>
                                            </select>
                                        <?php }?>
                                    </div>

                                    <div class="form-group col-md-3" style="display: block;">
                                        <label for="fecha_respuesta">Fecha de respuesta</label>
                                        <input <?php if (($this->auth->usuario()->medico_nivel == '0')) echo "readonly"; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_fecha_respuesta; ?>" name="fecha_respuesta" id="fecha_respuesta" type="date" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-2" style="display: block;">
                                        <label for="num_oficio_respuesta">N° de oficio</label>
                                        <input <?php if (($this->auth->usuario()->medico_nivel == '0')) echo "readonly"; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_num_oficio_respuesta; ?>" name="num_oficio_respuesta" id="num_oficio_respuesta" type="text" class="form-control" placeholder="">
                                    </div>

                                    <div class="form-group col-md-4" style="display: block;">
                                        <label for="estado_respuesta">Estado de la respuesta</label><br>
                                        <!-- Calculo fecha de vencimiento -->
                                        <?php
                                            $sumarDias = $historiaMedica->historia_dias; //Dias que se establecieron como plazo para responder
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
                                        <input <?php if (($this->auth->usuario()->medico_nivel == '0')) echo "readonly"; ?> onblur="Mayuscula(this);" value="<?php echo $historiaMedica->historia_respuesta; ?>" name="respuesta" id="respuesta" type="text" class="form-control" placeholder="">
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