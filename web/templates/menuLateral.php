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

<aside class="overflow-auto col-2 bg-azul-oscuro p-3 rounded-3 ms-2  mt-2 d-flex flex-column align-items-center align-self-start menu d-none d-lg-flex">
  <img src='../app/archivos/img/perfil/<?php echo $_SESSION["foto_perfil"] ?>' class="rounded-circle img-fluid fotoPerfil ">
  <div id="datosPersonales" class="d-flex flex-column justify-content-center align-items-center m-3 txt-naranja">
    <div class="d-flex align-items-center">
      <img id="logo" src="../app/archivos/img/logos/palsplans-logo.png" class="logo-menu rounded d-none d-xxl-block">
      <div class="ms-2 d-none d-xl-block">
        <span class="fw-bold"><?php echo ($_SESSION['nombre']); ?></span><br>
        <span><?php echo ($_SESSION['email']); ?></span>
      </div>
    </div>
  </div>
  <div id="datosCirculos" class="d-flex flex-column justify-content-center align-items-start m-3 text-light">
    <span class="m-2"><a href="index.php?ctl=inicio" class="text-light">Inicio</a></span>
    <?php if ($_SESSION["nivel"] != 2) { ?>
      <span class="m-2"><a href="index.php?ctl=perfil&user=<?php echo ($_SESSION["id_user"]) ?>"
          class="text-light">Perfil</a></span>
    <?php } ?>
    <?php if ($_SESSION["nivel"] != 2) { ?>
      <span class="m-2"><a href="index.php?ctl=solicitudes" class="text-light">Solicitudes</a>

        <?php
        if (count($solicitudesGrupo) > 0 || count($solicitudesPlan) > 0) {
          echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffa62b" class="bi bi-bell-fill"
              viewBox="0 0 16 16">
              <path
                d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
            </svg>';
        }
        ?>

      </span>
      <span class="m-2"><a class="text-light" href="index.php?ctl=crearCirculo"><div class=" d-flex justify-content-center"></div>Crear  círculo</a></span>
    <?php } ?>
  </div>
  <?php if ($_SESSION["nivel"] != 2) { ?>
    <div class="busqueda mt-3">
      <form action="index.php?ctl=buscarUsuario" method="post">
        <div class="searchbar">
          <div class="form-floating d-flex flex-column align-items-center justify-content-center d-xl-flex">
            <input type="text" class="form-control rounded-3" id="buscar_usuario" placeholder="Busca un usuario"
              name="buscar_usuario">
            <label for="email" class="d-block">Busca un usuario</label>
            <button class="mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light p-3 mt-lg-1" name="bBuscar">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search d-none d-xl-block"
                viewBox="0 0 16 16">
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
              </svg>
              <span class="d-block d-xl-none fs-6">Buscar</span>
            </button>
          </div>
        </div>
      </form>
    </div>
  <?php } ?>
  <div id="cerrarSesion" class="d-flex flex-column justify-content-center align-items-center m-3 text-light">
    <span><a class="text-light" href="index.php?ctl=cerrarSesion">Cerrar sesión</a></span>
  </div>
</aside>


