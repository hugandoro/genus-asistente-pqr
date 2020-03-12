<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?c=Historia&token=<?php echo @$_GET['token']; ?>">GECOPA Web</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Historias clinicas <span class="sr-only">(current)</span></a></li> -->
        <!-- <li><a href="#">Consultas medicas</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Historias clinicas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="?c=Historia&a=crud_Previo&token=<?php echo @$_GET['token']; ?>">Crear historia</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="?c=Historia&token=<?php echo @$_GET['token']; ?>">Buscar historia</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="?c=Historia&a=crud_Identificacion_Previo&token=<?php echo @$_GET['token']; ?>">Modificar N° de identificacion de una Historia</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Citas medicas <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="?c=Cita&token=<?php echo @$_GET['token']; ?>">Cronologia de citas medicas</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informacion institucional <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a target="_blank" href="http://sanlazarocolombia.com">Portal web</a></li>
            <li role="separator" class="divider"></li>
            <li><a target="_blank" href="http://sanlazarocolombia.com/index.php/quienes-somos/nuestra-mision">Nuestra mision</a></li>
            <li><a target="_blank" href="http://sanlazarocolombia.com/index.php/quienes-somos/nuestra-vision">Nuestra vision</a></li>
            <li><a target="_blank" href="http://sanlazarocolombia.com/index.php/quienes-somos/quienes-somos">Quienes somos</a></li>
            <li role="separator" class="divider"></li>
            <li><a target="_blank" href="http://sanlazarocolombia.com/index.php/productos">Nuestros productos</a></li>
            <li><a target="_blank" href="http://sanlazarocolombia.com/index.php/nuestros-servicios">Nuestros servicios</a></li>
          </ul>
        </li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php echo $this->auth->usuario()->medico_nombres ." ". $this->auth->usuario()->medico_apellidos; ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="?c=auth&a=desconectarse">Desconectarse</a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>