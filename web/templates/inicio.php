<div class="d-none d-sm-block d-lg-none">
  <?php include("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include("bannerMovil.php"); ?>
</div>

<div class="ms-2 me-2 mt-2 row d-flex justify-content-around d-block d-sm-none">
  <button class="col-5 btn btn-info bg-azul-medio" id="btnMenuPlanesInicio" nombre="btnMenuPlanes">Planes</button>
  <button class="col-5 btn btn-info bg-azul-claro" id="btnMenuCirculosInicio" nombre="btnMenuCirculos">Circulos</button>
</div>

  <div class="d-flex justify-content-center justify-content-sm-between majorInicio">

    <?php include("menuLateral.php"); ?>
    

<!-- planes -->
    <div id="divPlanesInicio" class="d-flex flex-column bg-azul-oscuro m-2 p-3 rounded col-11 col-sm-10 col-lg-8 col-xxl-7 principalInicio overflow-auto">
      <?php
      if (count($planesUsuario) > 0) {
        echo '<h1 class="txt-naranja fw-bold">Próximos planes</h1>';


      } else {
        echo '<div class="d-flex flex-column align-items-center">';
        echo '    <h1 class="text-light mt-3">No tienes planes por ahora :(</h1>';
        echo '    <img  class="mt-5" src="../app/archivos/img/logos/palsplans-logo.png">';
        echo '</div>';
      }
      ?>

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
        }
        ?>

      </div>

    </div>
<!-- circulo -->
    <div id="divCirculosInicio" class="principalInicio d-none d-sm-flex bg-azul-oscuro mt-2 me-2 p-3 col-11 col-sm-1 col-xxl-2 rounded flex-column align-self-start menu2">
      <div>
        <h3 class="txt-naranja fw-bold fs-5 d-none d-xl-block">Mis círculos</h3>
      </div>
      <div class="circulos overflow-auto misCirculos">
        


        <?php
        if (count($MisGrupos) < 1) {
          echo '<div><p class="text-light">Todavia no estas en ningún círculo</p></div>';
        } else {
          for ($i = 0; $i < count($MisGrupos); $i++) {
            $grupo = $MisGrupos[$i];

            echo '  <div class="d-flex justify-content-around align-items-center flex-grow-1 ">';
            echo '<div class="flex-grow-1">';
            echo '    <form action="index.php?ctl=circulo&id=' . $grupo["IdGrupo"] . '" method="post" class="container align-self-center d-flex flex-grow-1 align-items-center justify-content-center">';
            echo '      <button type="submit" class="text-decoration-none mb-2 rounded divMiGrupo bg-azul-medio btn-link d-flex flex-grow-1 justify-content-betweem" style="border: none; padding: 0; background: none;">';
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

  </div>


  <script src="scripts/inicio.js"></script>
<?php include ('layout.php'); ?>





