<div class="d-flex justify-content-between">

  <?php include ("menuLateral.php"); ?>

  <div class="d-flex justify-content-end">
    <div class="bg-azul-oscuro mt-2 me-5 rounded p-3 principal overflow-auto">
      <h2 class="text-light fw-bold">Círculos:</h2>




      <?php
      for ($i = 0; $i < count($grupos); $i++) {
        $g = $grupos[$i];

        echo '<a class="text-decoration-none text-dark" href="index.php?ctl=circulo&id=' . $g["IdGrupo"] . '">';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="idUsuarioInvitar" value="' . $g['IdGrupo'] . '">';

        echo '<div class="row">';
        echo '  <div class="p-3 d-flex container">';
        echo '    <div class="row bg-azul-claro flex-grow-1 align-items-center justify-content-between rounded p-2">';
        echo '      <div class="col-5 d-flex">';
        echo '        <div>';
        echo '          <img src="../app/archivos/img/circulos/' . $g["FotoGrupo"] . '" class="rounded ms-2 imgBUser">';
        echo '        </div>';
        echo '        <div class="d-flex flex-column align-items-start mt-2 ms-3 fw-bold">';
        echo '          <p>' . $g["Nombre"] . '</p>';
        echo '        </div>';
        echo '      </div>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';

        echo '</form>';
        echo '</a>';
      }


      ?>


    </div>
  </div>
</div>



<?php include 'layout.php' ?>