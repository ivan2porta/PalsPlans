<?php 
try{
  $cs = new Consultas();
  $solicitudesGrupo = $cs->obtenerGruposUsuarioSinConfirmar($_SESSION["id_user"]);
  $solicitudesPlan = $cs->obtenerPlanesUsuarioSinConfirmar($_SESSION["id_user"]);
} catch (Exception $e) {
  error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
  header('Location: index.php?ctl=error');
} catch (Error $e) {
  error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
  header('Location: index.php?ctl=error');
}

?>

<div id="movilM" class="d-flex justify-content-between bg-azul-oscuro">
  <header>
    <div id="hamburguer-icon" class="p-2" onclick=toogleMobileMenu(this)>
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
      <ul class="mobile-menu bg-azul-oscuro rounded-bottom z-3 pt-5 pb-5 border border-top-0 border-info border-5">
        <li><img src="../app/archivos/img/perfil/<?php echo $_SESSION["foto_perfil"]?>" class="rounded imgMenuMovil"></li>
        <li><a href="index.php?ctl=inicio" class="text-light fs-3 fw-bold">Inicio</a></li>
        <?php if ($_SESSION["nivel"] != 2) { ?>
          <li>
            <a href="index.php?ctl=perfil&user=<?php echo ($_SESSION["id_user"]) ?>"
              class="text-light fs-3 fw-bold">Perfil</a>
          </li>
        <?php } ?>
        <?php if ($_SESSION["nivel"] != 2) { ?>
          <li>
            <span class="m-2">
            <a href="index.php?ctl=solicitudes" class="text-light fs-3 fw-bold">Solicitudes</a>

              <?php
              if (count($solicitudesGrupo) > 0 || count($solicitudesPlan) > 0) {
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffa62b" class="bi bi-bell-fill" viewBox="0 0 16 16">
          <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
        </svg>';
              }
              ?>

            </span>
          </li>
        <?php } ?>
        <li class="nav-item d-flex justify-content-center">
          <a class="nav-link fs-3 fw-bold" data-bs-toggle="modal" data-bs-target="#searchModal">Buscar usuario</a>
        </li>
        <li><span class="m-2"><a href="index.php?ctl=crearCirculo" class="text-light fs-3 fw-bold">Crear
              círculo</a></span></li>
        <li><a href="index.php?ctl=cerrarSesion" class="text-light fs-3 fw-bold">Cerrar sesión</a></li>
      </ul>
    </div>
  </header>

  <div class="p-2">
    <img id="logobmovil" src="../app/archivos/img/logos/palsplans-logo.png">
  </div>
</div>


<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-azul-medio">
        <h5 class="modal-title" id="searchModalLabel">Buscar usuario</h5>
        <button type="button" class="btn-close" name="boton_buscar" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-crudo">
        <!-- Código del formulario de búsqueda dentro del modal -->
        <form action="index.php?ctl=buscarUsuario" method="post">
          <input class="form-control" id="buscar_usuario" name="buscar_usuario" type="search"
            placeholder="Buscar usuario" aria-label="Buscar usuario">
          <button class="btn btn-warning bg-naranja text-light mt-2" name="bBuscar" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function toogleMobileMenu(element) {
    element.classList.toggle("open");
  }
</script>

