<div class="d-none d-sm-block d-lg-none">
  <?php include ("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include ("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

  <?php include ("menuLateral.php"); ?>

  <div class="container">
    <div class="d-flex flex-column bg-azul-oscuro mt-2  ps-5 pe-5 pt-2 pb-2 rounded  principal overflow-auto">

      <h2 class="text-light fw-bold">Usuarios:</h2>

      <?php
      for ($i = 0; $i < count($usuarios); $i++) {
        $us = $usuarios[$i];
        try {
          $cs = new Consultas();
          $gruposUsuario = $cs->obtenerGruposUsuario($us["IdUsuario"]);
          $gruposDisponibles = obtenerNoRepetidos($gruposDeUsuario, $gruposUsuario);

          if ($_SESSION["id_user"] != $us["IdUsuario"] && $us["Nivel"] != 2) {
            echo '<div class="row mb-3">';
            echo '  <div class="d-flex">';
            echo '    <div class="row bg-azul-claro flex-grow-1 align-items-center justify-content-between rounded p-2">';
            echo '      <a class="col-12 col-md-5 col-lg-4 d-flex text-decoration-none text-dark" href="index.php?ctl=perfil&user=' . $us["IdUsuario"] . '">';
            echo '        <div>';
            echo '          <img src="../app/archivos/img/perfil/' . $us["FotoPerfil"] . '" class="rounded ms-2 imgBUser">';
            echo '        </div>';
            echo '        <div class=" mt-2 ms-3 fw-bold">';
            echo '          <p>' . $us["Nombre"] . '</p>';
            echo '          <p class="d-none d-md-block">' . $us["Email"] . '</p>';
            echo '        </div>';
            echo '      </a>';
            if (count($gruposDisponibles) > 0) {
                echo '      <div class="col-12 col-md-6 col-lg-7  me-3 mt-2 mt-md-0 justify-content-md-between align-items-md-center">';
                echo '        <form method="post" action="" class="d-flex flex-grow-1 flex-column  flex-md-row">';
                echo '          <input type="hidden" name="idUsuarioInvitar" value="' . $us['IdUsuario'] . '">';
                echo '          <div class="form-floating flex-grow-1">';
                echo '            <select id="grupoInvitar" name="grupoInvitar" class="form-control rounded-3" required>';
                for ($j = 0; $j < count($gruposDisponibles); $j++) {
                    $grupo = $gruposDisponibles[$j];
                    echo '              <option value="' . $grupo["IdGrupo"] . '">' . $grupo["Nombre"] . '</option>';
                }
                echo '            </select>';
                echo '            <label for="usuarios">Invitar al grupo:</label>';
                echo '          </div>';
                echo '          <button id="btnInvitar" class="mb-2 ms-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end" name="btnInvitar">Invitar</button>';
                echo '        </form>';
                echo '      </div>';
            }
            echo '    </div>';
            echo '  </div>';
            echo '</div>';

          }
        } catch (Exception $e) {
          error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
          header('Location: index.php?ctl=error');
        } catch (Error $e) {
          error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
          header('Location: index.php?ctl=error');
        }


      }
      ?>

    </div>


  </div>

</div>
<?php include 'layout.php' ?>