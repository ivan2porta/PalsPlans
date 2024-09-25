<div class="d-none d-sm-block d-lg-none">
  <?php include("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

  <?php include("menuLateral.php"); ?>

  <div class="container">
    <div class="d-flex flex-column bg-azul-oscuro mt-2  p-3 rounded  principal overflow-auto">


      <div class="d-flex flex-column flex-md-row flex-md-row align-items-center">
        <div class="info d-flex ">
          <img src="../app/archivos/img/planes/<?php echo ($plan["FotoActividad"]) ?>" class="rounded me-3 imgPlan">
        </div>
        <div class="d-flex  flex-grow-1 mt-3 flex-column">
          <div class="d-flex justify-content-center justify-content-md-between">
            <div>
              <h2 class="txt-naranja fw-bold ms-3"><?php echo ($plan["Nombre"]) ?></h2>
            </div>
            <div>
              <form method="post" action="" class="d-none d-md-block">
                <?php
                if ($_SESSION["id_user"] === $plan["Creador"]) {
                  ?>
                  <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end" name="bEliminarPlan"
                    id="bEliminarPlan">Eliminar plan</button>
                  <?php
                } else if ($participacion) {
                  ?>
                    <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end" name="bSalirPlan"
                      id="bSalirPlan">Salir del plan</button>
                  <?php
                } else if ($_SESSION["nivel"] != 2) {
                  ?>
                      <button id="bUnirmePlan"
                        class="mb-2 me-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
                        name="bUnirmePlan">Unirme al plan</button>
                  <?php
                }

                ?>
              </form>
            </div>
          </div>
          <div class="mt-0 p-3 d-flex flex-column align-items-center align-items-md-start">
            <p class="text-light"><?php echo ($plan["Descripcion"]) ?></p>
          </div>
          <div class="mt-0 p-3 d-flex flex-column align-items-center">
            <a href="index.php?ctl=circulo&id=<?php echo ($grupo["IdGrupo"]) ?>"
              class="text-light"><?php echo ("Volver a " . $grupo["Nombre"]) ?></a>
          </div>
        </div>
      </div>

      <div class="d-flex flex-column flex-md-row flex-1 align-items-center justify-content-md-between mb-2 mt-3">
        <p class='text-light fw-bold'>Ubicación: <?php echo ($plan["Ubicacion"]) ?></p>
        <p id="ptemp" class="text-light fw-bold"></p>
        <p id="pcli" class="text-light fw-bold"></p>
        <p class='text-light fw-bold'>Presupuesto: <?php echo ($plan["PresupuestoEstimado"]) ?>€</p>
        <div>
          <?php
          if ($plan["FechaRealizacion"] == $plan["FechaFin"]) {
            echo ("<span class='text-light fw-bold'>Fecha: " . $plan["FechaRealizacion"] . "</span>");
          } else {
            echo ("<p class='text-light fw-bold'>Fecha de inicio: " . $plan["FechaRealizacion"] . "</p>
              <p class='text-light fw-bold'>Fecha de finalización: " . $plan["FechaFin"] . "</p>");
          }
          ?>
        </div>
      </div>

      <div class="d-flex mt-2 ">
        <div class="d-flex align-items-center flex-grow-1">
          <div id="divMiembros"
            class="d-flex flex-grow-1 justify-content-center align-items-center bg-azul-medio rounded-top p-3 divCategoria">
            <h3 class="fw-bold text-light">Miembros</h3>
          </div>
          <div class="d-flex justify-content-end flex-grow-1">
            <?php
            if ($_SESSION["id_user"] === $plan["Creador"]) {
              ?>
              <button id="bEditarPlan"
                class="mb-2 me-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
                name="bEditarPlan">Editar plan</button>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div id="contenidoP" class="bg-azul-medio p-3 ps-5 pe-5 rounded-bottom">



        <div id="contenidoMiembros" class="d-block">
          <div class="row">
            <?php
            for ($i = 0; $i < count($usuarios); $i++) {
              $miembro = $usuarios[$i];

              echo '<div class="col-12 col-md-6 p-3 d-flex">';
              echo '<a class="text-decoration-none text-dark flex-grow-1" href=index.php?ctl=perfil&user=' . $miembro["IdUsuario"] . '>';
              echo '  <div class="d-flex bg-azul-claro flex-grow-1 justify-content-between rounded p-2">';
              echo '    <div class="d-flex mt-1">';
              echo '      <img src="../app/archivos/img/perfil/' . $miembro["FotoPerfil"] . '" class="rounded imgBUser">';
              echo '      <div class="d-flex flex-column align-items-start ms-2 fw-bold">';
              echo '        <p>' . $miembro["Nombre"] . '</p>';
              echo '        <p class="d-none d-xs-block">' . $miembro["Email"] . '</p>';
              echo '      </div>';
              echo '    </div>';

              if ($_SESSION["id_user"] == $plan["Creador"] && $_SESSION["id_user"] != $miembro["IdUsuario"]) {
                echo '    <form action="" method="post">';
                echo '      <input type="hidden" name="idGrupoEl" value="' . $plan["IdActividad"] . '">';
                echo '      <input type="hidden" name="idUsuarioEl" value="' . $miembro["IdUsuario"] . '">';
                echo '      <button type="submit" class="btn btn-lg rounded-3 btn-danger text-light align-self-center" name="bExpulsarGrupo">';
                echo '        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">';
                echo '          <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0" />';
                echo '        </svg>';
                echo '      </button>';
                echo '    </form>';
              }

              echo '  </div>';
              echo '</a>';
              echo '</div>';


            }
            ?>






          </div>
        </div>

        <div id="divEditarPlan" class="d-none">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="container d-flex justify-content-between my-2">
              <small class="text-body-secondary">Los campos que dejes en blanco, mantendrán su valor actual</small>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="text" class="form-control" id="nombrePlan" placeholder="Nombre del plan"
                  name="nombrePlan" />
                <label for="Nombre del plan">Nombre del plan</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <textarea class="form-control" id="descripcion" placeholder="Descripción del plan" name="descripcion"
                  rows="10"></textarea>
                <label for="descripcion">Descripción del plan</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="number" class="form-control" id="presupuestoEstimado" placeholder="Presupuesto estimado"
                  name="presupuestoEstimado">
                <label for="presupuestoEstimado">Presupuesto estimado</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="text" class="form-control" id="ubi" placeholder="Ubicación" name="ubi">
                <label for="ubi">Ubicación</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaInicio" placeholder="Fecha de inicio"
                  name="fechaInicio">
                <label for="fechaInicio">Fecha de inicio</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaFinalizacion" placeholder="Fecha de finalización"
                  name="fechaFinalizacion">
                <label for="fechaFinalizacion">Fecha de finalizacion</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaConfirmacion" placeholder="Fecha de confirmacion"
                  name="fechaConfirmacion">
                <label for="FechaConfirmacion">Fecha de confirmación</label>
              </div>
            </div>

            <label for="foto">Foto del plan</label>
            <div class="form-floating m-2">

              <div>
                <input type="file" class="form-control rounded-3" id="foto" name="foto" />
              </div>
            </div>

            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="bePlan" name="bePlan"
              type="submit">Editar plan</button>
          </form>
        </div>

      </div>





    </div>


  </div>

</div>
<script src="scripts/plan.js"></script>


<?php include 'layout.php' ?>