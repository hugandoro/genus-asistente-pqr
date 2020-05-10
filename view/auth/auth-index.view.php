<!-- Vista para pantalla de login --> 
<h1 class="page-header" align="Center">Asistente virtual - Seguimiento radicados PQR</h1>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
        <center><picture><img src="assets/img/asistente.png" class="img-fluid" width="230px"></picture></center>
    </div>
    <div class="col-sm-5">
        <!-- El form de logueo hace un llamado al controlador Auth con la accion/metodo Autenticar --> 
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Validacion de acceso</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="?c=Auth&a=Autenticar" role="login">
                    <input type="text" name="usuario" placeholder="Usuario" required class="form-control" value="" autocomplete="off" />
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="off" />
                    <hr />
                    <button type="submit" name="go" class="btn btn-lg btn-default btn-block">Ingresar</button>
                </form>
            </div>
          </div>
    </div>
    <div class="col-sm-2"></div>
</div>