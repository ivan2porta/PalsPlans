<div class="d-none d-sm-block d-lg-none">
  <?php include ("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include ("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

  <?php include ("menuLateral.php"); ?>

  <div class="container">
    <div class="d-flex flex-column bg-azul-oscuro mt-2  p-3 rounded  principal overflow-auto">
      <div class="d-flex flex-column flex-md-row align-items-center">
        <div class="info d-flex ">
          <img src="../app/archivos/img/circulos/<?php echo ($datosCirculo["FotoGrupo"]) ?>"
            class="rounded me-0 me-md-3 imgPaginaCirculo">
        </div>
        <div class="d-flex  flex-grow-1 mt-3 flex-column">
          <div class="d-flex justify-content-between">
            <div>
              <h2 class="txt-naranja fw-bold ms-3"><?php echo ($datosCirculo["Nombre"]) ?></h2>
            </div>

            <div>
              <form method="post" action="" class="d-none d-md-block">
                <?php
                if ($_SESSION["id_user"] === $datosCirculo["Creador"] || $_SESSION["nivel"] == 2) {
                  ?>
                  <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end"
                    name="bEliminarCirculo" id="bEliminarCirculo">Eliminar círculo</button>
                  <?php
                } else {
                  ?>
                  <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end" name="bSalirCirculo"
                    id="bSalirCirculo">Salir del círculo</button>
                  <?php
                }
                ?>
              </form>
            </div>



          </div>
          <div class="mt-0 p-3">
            <p class="text-light"><?php echo ($datosCirculo["Descripcion"]) ?></p>
          </div>
          <div class="d-flex flex-column">
            <form method="post" action="" class="d-block d-md-none flex-grow-1">
              <?php
              if ($_SESSION["id_user"] === $datosCirculo["Creador"] || $_SESSION["nivel"] == 2) {
                ?>
                <button class="btn btn-lg rounded-3 btn-danger text-light align-self-end" name="bEliminarCirculo"
                  id="bEliminarCirculoMovil">Eliminar círculo</button>
                <?php
              } else {
                ?>
                <button class="mb-2 btn btn-lg rounded-3 btn-danger mt-2 text-light align-self-end" name="bSalirCirculo"
                  id="bSalirCirculoMovil">Salir del círculo</button>
                <?php
              }
              ?>
            </form>
            <?php if ($_SESSION["nivel"] != 2) { ?>
              <button id="cplanMovil"
                class="mb-2 d-block d-md-none btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
                name="bCPlan">Crear plan</button>
            <?php } ?>
            <?php
            if ($_SESSION["id_user"] === $datosCirculo["Creador"]) {
              ?>
              <button id="bEditarCirculoMovil"
                class="mb-2 d-block d-md-none btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
                name="bEditarCirculo">Editar círculo</button>
              <?php
            }
            ?>
          </div>
        </div>
      </div>

      <div class="d-flex mt-5 ">
        <div class="d-flex align-items-center flex-grow-1">
          <div id="divPlanes" name="divPlanes"
            class="d-flex border-end flex-grow-1 justify-content-center align-items-center bg-azul-medio rounded-top p-3 divCategoria">
            <h3 class="fw-bold text-light">Planes</h3>
          </div>
          <div id="divMiembros"
            class="d-flex flex-grow-1 justify-content-center align-items-center bg-azul-claro rounded-top p-3 divCategoria">
            <h3 class="fw-bold text-light">Miembros</h3>
          </div>
        </div>
        <div class="d-flex justify-content-end flex-grow-1">
          <?php
          if ($_SESSION["id_user"] === $datosCirculo["Creador"]) {
            ?>
            <button id="bEditarCirculo"
              class="d-none d-md-block mb-2 me-2 btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
              name="bEditarCirculo">Editar círculo</button>
            <?php
          }
          ?>
          <?php if ($_SESSION["nivel"] != 2) { ?>
            <button id="cplan"
              class="mb-2 d-none d-md-block btn btn-lg rounded-3 btn-warning bg-naranja mt-2 text-light align-self-end"
              name="bCPlan">Crear plan</button>
          <?php } ?>
        </div>
      </div>
      <div id="contenidoP" class="bg-azul-medio p-3  rounded-bottom">

        <div id="contenidoPlanes" class="d-block">
          <div class="row">

            <?php
            if (count($planesDeGrupo) == 0) {
              echo "<div class='col-12'><h2 class='text-light'>Este grupo no tiene planes</h2></div>";
            } else {
              for ($i = 0; $i < count($planesDeGrupo); $i++) {
                $plan = $planesDeGrupo[$i];

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
            }
            ?>


          </div>
        </div>

        <div id="contenidoMiembros" class="d-none">
          <div class="row">
            <?php

            for ($i = 0; $i < count($miembrosCirculo); $i++) {
              $miembro = $miembrosCirculo[$i];

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

              if ($_SESSION["id_user"] == $datosCirculo["Creador"] && $_SESSION["id_user"] != $miembro["IdUsuario"]) {
                echo '    <form action="" method="post">';
                echo '      <input type="hidden" name="idGrupoEl" value="' . $datosCirculo["IdGrupo"] . '">';
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
        
        <div id="divCrearPlan" class="d-none">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="container d-flex justify-content-between my-2">
              <small class="text-body-secondary">Los campos con * son obligatorios</small>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="text" class="form-control" id="nombrePlan" placeholder="Nombre del plan" name="nombrePlan"
                  required />
                <label for="Nombre del plan">Nombre*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <textarea class="form-control" id="descripcion" placeholder="Descripción del plan" name="descripcion"
                  rows="10" required></textarea>
                <label for="descripcion">Descripción*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="number" class="form-control" id="presupuestoEstimado" placeholder="Presupuesto estimado"
                  name="presupuestoEstimado" required>
                <label for="presupuestoEstimado">Presupuesto*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="text" class="form-control" id="ubi" placeholder="Ubicación" name="ubi" required>
                <label for="ubi">Ubicación*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaInicio" placeholder="Fecha de inicio"
                  name="fechaInicio" required>
                <label for="fechaInicio">Desde*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaFinalizacion" placeholder="Fecha de finalización"
                  name="fechaFinalizacion" required>
                <label for="fechaFinalizacion">Hasta*</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="date" class="form-control" id="fechaConfirmacion" placeholder="Fecha de confirmacion"
                  name="fechaConfirmacion" required>
                <label for="FechaConfirmacion">Confirmación*</label>
              </div>
            </div>

            <label for="foto">Foto del plan</label>
            <div class="form-floating m-2">

              <div>
                <input type="file" class="form-control rounded-3" id="foto" name="foto" />
              </div>
            </div>

            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="bCrearPlan"
              name="bCrearPlan" type="submit">Crear plan</button>
          </form>
        </div>

        <div id="divEditarCirculo" class="d-none">
          <form action="" method="post" enctype="multipart/form-data">

            <label for=""></label>
            <div class="container d-flex justify-content-between my-2">
              <small class="text-body-secondary">Los campos que dejes en blanco, mantendrán su valor actual</small>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <input type="text" class="form-control" id="nombreg" placeholder="Nombre del círculo" name="nombreg"/>
                <label for="nombreg">Nombre del círculo</label>
              </div>
            </div>

            <div class="input-group">
              <div class="form-floating m-2">
                <textarea class="form-control" id="descripcion" placeholder="Descripción del círculo" name="descripcion"
                  rows="10"></textarea>
                <label for="descripcion">Descripción del círculo</label>
              </div>
            </div>

            <label for="foto">Foto del círculo</label>
            <div class="form-floating m-2">

              <div>
                <input type="file" class="form-control rounded-3" id="foto" name="foto" />
              </div>
            </div>

            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="bEditarCirculo2"
              name="bEditarCirculo2" type="submit">Editar círculo</button>
          </form>

        </div>

      </div>

    </div>


  </div>

</div>





<script src="scripts/circulo.js"></script>

<?php include 'layout.php' ?>