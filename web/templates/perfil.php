<div class="d-none d-sm-block d-lg-none">
  <?php include ("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include ("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

  <?php include ("menuLateral.php"); ?>

  <div class="container">
    <div class="d-flex flex-column bg-azul-oscuro mt-2  p-1 rounded  principal overflow-auto">
      <div class="bg-azul-oscuro  rounded p-3">
        <div class="d-flex flex-column flex-md-row">
          <div class="info d-flex align-items-center justify-content-center">
            <?php
            if ($_SESSION["id_user"] != $_GET["user"]) {
              echo '<img src="../app/archivos/img/perfil/' . $usuario["FotoPerfil"] . '" class="rounded  imgPaginaCirculo">';
            }
            ?>
          </div>
          <div class="d-flex  flex-grow-1 mt-3 flex-column">
            <div class="d-flex justify-content-between">
              <div>
                <h2 class="txt-naranja fw-bold ms-3"><?php echo ($usuario["Nombre"]) ?></h2>
              </div>
              <?php if ($_SESSION["id_user"] == $_GET["user"]) { ?>
                <div class="d-flex justify-content-end flex-grow-1">
                  <button id="bEditarPerfil"
                    class=" mb-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
                    name="bEditarPerfil">Editar perfil</button>
                </div>
              <?php } else if ($_SESSION["nivel"] == 2) { ?>
                  <div class="d-flex justify-content-end flex-grow-1">
                    <form method="post" action="">
                      <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end" type="submit"
                        name="bEliminarUsuario" id="bEliminarUsuario">Eliminar usuario</button>
                    </form>
                  </div>
              <?php } ?>

            </div>
            <div class="mt-0 p-3">
              <?php if ($_SESSION["id_user"] != $_GET["user"]) { ?>
                <p class="text-light"><?php echo ($usuario["Email"]) ?></p>
              <?php } ?>
              <p class="text-light"><?php echo ($usuario["Descripcion"]) ?></p>
            </div>
          </div>

        </div>

        <?php if ($_SESSION["id_user"] == $_GET["user"] || $_SESSION["nivel"] == 2) { ?>
          <div class="d-flex mt-1 mt-md-5 flex-grow-1 ">
            <div class="d-flex align-items-center flex-grow-1">
              <div id="divCirculos" name="divCirculos"
                class="d-flex border-end flex-grow-1 justify-content-center align-items-center bg-azul-medio rounded-top p-3 divCategoria">
                <h3 class="fw-bold text-light">Círculos</h3>
              </div>
              <div id="divPlanes"
                class="d-flex flex-grow-1 justify-content-center align-items-center bg-azul-claro rounded-top p-3 divCategoria">
                <h3 class="fw-bold text-light">Planes</h3>
              </div>
            </div>
          </div>
          <div id="contenidoP" class="bg-azul-medio p-3 ps-1 pe-1 ps-sm-5 pe-sm-5 rounded-bottom">
          <?php } ?>
          <?php if ($_SESSION["id_user"] == $_GET["user"] || $_SESSION["nivel"] == 2) { ?>
            <div id="contenidoCirculos" class="d-block">
              <div class="row">

                <?php
                if (count($grupos) < 1) {
                  echo '<div class="d-flex justify-content-center"><p class="text-light fs-2">No hay círculos disponibles</p></div>';
                } else {
                  for ($i = 0; $i < count($grupos); $i++) {
                    $grupo = $grupos[$i];

                    echo '  <div class="d-flex justify-content-around align-items-center flex-grow-1 col-12 col-md-6">';
                    echo '<div class="flex-grow-1">';
                    echo '    <form action="index.php?ctl=circulo&id=' . $grupo["IdGrupo"] . '" method="post" class="container align-self-center d-flex flex-grow-1 align-items-center justify-content-center">';
                    echo '      <button type="submit" class="text-decoration-none mb-2 rounded divMiGrupo bg-azul-claro btn-link d-flex flex-grow-1 justify-content-betweem" style="border: none; padding: 0; background: none;">';
                    echo '      <input type="hidden" name="id_grupo" value="' . $grupo["IdGrupo"] . '">';
                    echo '        <img src="../app/archivos/img/circulos/' . $grupo["FotoGrupo"] . '" class="rounded-circle imgBCirculo p-1">';
                    echo '        <p class="align-self-center fw-bold text-light outline-none d-sm-none d-xxl-block">' . $grupo["Nombre"] . '</p>';
                    echo '      </button>';
                    echo '    </form>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
                ?>


              </div>
            </div>

            <div id="contenidoPlanes" class="d-none">
              <div class="row">
                <?php
                if (count($planesUsuario) > 0) {

                  for ($i = 0; $i < count($planesUsuario); $i++) {
                    $plan = $planesUsuario[$i];

                    echo '<div class="col-12 col-md-6">';
                    echo '  <div class="m-1 m-xl-3 ">';
                    echo '    <div class="card bg-azul-claro cardPlan">';
                    echo '      <img src="../app/archivos/img/planes/' . $plan["FotoActividad"] . '" alt="" class="imagen-plan rounded">';
                    echo '      <div class="card-body">';
                    echo '        <h5 class="card-title">' . $plan["Nombre"] . '</h5>';
                    echo '        <p class="card-text overflow-auto d-none d-lg-block">' . $plan["Descripcion"] . '</p>';
                    echo '        <form method="post" action="index.php?ctl=plan&idPlan=' . $plan["IdActividad"] . '&u=' . urlencode($plan['Ubicacion']) . '&f=' . urlencode($plan["FechaRealizacion"]) . '">';
                    echo '          <div class="d-flex justify-content-between"><button type="submit" class="mb-2 btn btn-lg rounded-3 btn-warning bg-naranja text-light" name="bVerPlan" id="bVerPlan">Ver plan</button>';
                    echo '          <input type="hidden" name="idPlan" value="' . $plan["IdActividad"] . '">';
                    echo '          <span class="d-none d-sm-block d-md-none d-xl-block">Fecha: ' . $plan["FechaRealizacion"] . '</span></div>';
                    echo '        </form>';

                    echo '      </div>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';

                  }
                } else {
                  echo '<div class="d-flex justify-content-center"><p class="text-light fs-2">No hay planes disponibles</p></div>';
                }
                ?>
              </div>
            </div>

            <div id="divEditarPerfil" class="d-none">
              <form action="" method="post" enctype="multipart/form-data">

                <div class="container d-block d-xl-flex justify-content-between my-2">
                  <img src="../app/archivos/img/logos/logo-no-background.png" class="logoTexto d-none d-xl-block">
                  <small class="text-body-secondary">Los campos que dejes en blanco, mantendrán su valor actual</small>
                </div>

                <div class="form-floating m-2">
                  <input type="password" class="form-control rounded-3" id="pass" placeholder="Password" name="pass"/>
                  <label for="pass">Contraseña*</label>
                </div>

                <div class="mb-3 mx-5-md mx-5-lg">
                  La contraseña debe contener: <span id="mayus" class="">1 Mayúscula</span>, <span id="minus" class="">1
                    minúscula</span>, <span id="num" class="">1 número</span>, <span id="especial" class="">1 carácter
                    especial</span>.
                  <span id="longitud" class="">Entre 8 y 16 caracteres</span>
                </div>

                <div class="form-floating m-2">
                  <input type="password" class="form-control rounded-3" id="pass2" placeholder="Password" name="pass2"/>
                  <label for="pass2">Repita Contraseña*</label>
                </div>

                <div class="form-floating m-2">
                  <input type="date" class="form-control rounded-3" id="fecha" placeholder="Password" name="fecha"/>
                  <label for="fecha">Fecha de Nacimiento*</label>
                </div>

                <label for="descripcion">Descripción</label>
                <div class="form-floating m-2">
                  <textarea class="form-control rounded-3" id="descripcion" name="descripcion" rows="5"></textarea>
                  <label for="descripcion">Descripcion</label>
                </div>

                <label for="foto">Foto de perfil</label>
                <div class="form-floating m-2">
                  <div>
                    <input type="file" class="form-control rounded-3" id="foto" name="foto" />
                  </div>
                </div>

                <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="bEditarPerfil2" name="bEditarPerfil2"
                  type="submit">EditarPerfil</button>
              </form>
            </div>
          <?php } else {
            try {
              $cs = new Consultas();
              $gruposUsuario = $cs->obtenerGruposUsuario($_GET["user"]);
              $gruposDeUsuario = $cs->obtenerGruposDeUsuario($_SESSION["id_user"]);
              $us = $cs->buscarFila($_GET["user"], "usuario", "IdUsuario");
              $gruposDisponibles = obtenerNoRepetidos($gruposDeUsuario, $gruposUsuario);

              if ($_SESSION["id_user"] != $us["IdUsuario"]) {
                echo '<div class="mt-1 mt-md-5">';
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="idUsuarioInvitar" value="' . $us['IdUsuario'] . '">';

                echo '<div class="row">';
                echo '  <div class="p-3 d-flex container">';
                echo '    <div class="row bg-azul-claro flex-grow-1 d-flex align-items-center justify-content-center rounded p-2">';

                if (count($gruposDisponibles) > 0) {
                  echo '      <div class="d-flex flex-column flex-md-row me-md-3 justify-content-between align-md-items-center">';
                  echo '        <div class="form-floating d-flex flex-column flex-grow-1">';
                  echo '          <select id="grupoInvitar" name="grupoInvitar" class="form-control rounded-3" required>';
                  for ($j = 0; $j < count($gruposDisponibles); $j++) {
                    $grupo = $gruposDisponibles[$j];
                    echo '            <option value="' . $grupo["IdGrupo"] . '">' . $grupo["Nombre"] . '</option>';
                  }
                  echo '          </select>';
                  echo '        </div>';
                  echo '        <button id="btnInvitar"';
                  echo '          class="flex-grow-1 flex-md-grow-0 mb-2 ms-md-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-md-end"';
                  echo '          name="btnInvitar">Invitar al grupo</button>';
                  echo '      </div>';
                } else {
                  echo '      <p class="text-light fs-2">No tienes círculos a los que invitar a ' . $us["Nombre"] . '</p>';
                }
                echo '    </div>';
                echo '  </div>';
                echo '</div>';

                echo '</form>';

                echo '</div>';
              }
            } catch (Exception $e) {
              error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
              header('Location: index.php?ctl=error');
            } catch (Error $e) {
              error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
              header('Location: index.php?ctl=error');
            }
          } ?>

        </div>
        <?php
        if ($_SESSION["id_user"] != $_GET["user"]) {
          echo '<div class=" d-none d-lg-flex flex-grow-1 justify-content-center align-items-center"><img src="../app/archivos/img/logos/palsplans-logo.png"></div>';
        }
        ?>
      </div>

    </div>


  </div>

</div>


<script src="scripts/perfil.js"></script>

<?php include 'layout.php' ?>