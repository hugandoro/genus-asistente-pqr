<!-- Vista para pantalla de login --> 
<h1 class="page-header" align="Center">Bienvenido a Gecopa Web</h1>

<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">

        <!-- El form de logueo hace un llamado al controlador Auth con la accion/metodo Autenticar --> 
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Digite sus credenciales para ingresar...</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="?c=Auth&a=Autenticar" role="login">
                    <input type="text" name="usuario" placeholder="Usuario" required class="form-control" value="" autocomplete="off" />
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="off" />
                    <hr />
                    <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Ingresar</button>
                </form>
            </div>
          </div>

        
    </div>
</div>