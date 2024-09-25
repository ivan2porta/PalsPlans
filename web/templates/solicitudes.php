<div class="d-none d-sm-block d-lg-none">
    <?php include ("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
    <?php include ("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

    <?php include ("menuLateral.php"); ?>

    <div class="container">
        <div class="d-flex flex-column bg-azul-oscuro mt-2  p-3 rounded  principal overflow-auto p-3">


            <?php if ($_SESSION["nivel"] != 2) { ?>


                <div class="d-flex ">
                    <div class="d-flex align-items-center flex-grow-1">
                        <div id="divSolCirculos" name="divSolCirculos"
                            class="d-flex border-end flex-grow-1 justify-content-center align-items-center bg-azul-medio rounded-top p-3">
                            <h3 class="fw-bold text-light">Círculos</h3>
                        </div>
                        <div id="divSolPlanes"
                            class="d-flex flex-grow-1 justify-content-center align-items-center bg-azul-claro rounded-top p-3">
                            <h3 class="fw-bold text-light">Planes</h3>
                        </div>
                    </div>
                </div>
                <div id="contenido" class="bg-azul-medio p-3 rounded-bottom">
                    <div id="contenidoSolCirculos" class="d-block">
                        <?php
                        if (count($solicitudesGrupo) > 0) {
                            for ($i = 0; $i < count($solicitudesGrupo); $i++) {
                                $sol = $solicitudesGrupo[$i];
                                try {
                                    $cs = new Consultas();
                                    $admin = $cs->buscar($sol["Creador"], "usuario", "Nombre", "IdUsuario");
                                } catch (Exception $e) {
                                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                                    header('Location: index.php?ctl=error');
                                } catch (Error $e) {
                                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                                    header('Location: index.php?ctl=error');
                                }
                                echo '<div name="divSolCirculo" class="rounded p-2">';
                                echo '  <form method="post" action="">';
                                echo '    <div class="bg-azul-claro d-block d-flex p-2 rounded text-dark mt-2 align-items-center">';
                                echo '      <img src="../app/archivos/img/circulos/' . $sol['FotoGrupo'] . '" class="rounded-circle imgCirculo">';
                                echo '      <div class="d-flex flex-grow-1 m-1 justify-content-between">';
                                echo '        <div class="d-flex justify-content-center flex-column">';
                                echo '          <div><span class="fw-bold">' . $sol['Nombre'] . '</span></div>';
                                echo '          <div><span class="fw-bold">Te invita: ' . $admin . '</span></div>';
                                echo '        </div>';
                                echo '        <div class="d-flex flex-column align-self-end">';
                                echo '          <button class="mb-2 btn btn-lg rounded-3 btn-warning bg-naranja text-light" name="bAceptarSolCirculo" value="' . $sol['IdGrupo'] . '">';
                                echo '            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">';
                                echo '              <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />';
                                echo '            </svg>';
                                echo '          </button>';
                                echo '          <button class="mb-2 btn btn-lg rounded-3 btn-danger text-light" name="bRechazarSolCirculo" value="' . $sol['IdGrupo'] . '">';
                                echo '            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">';
                                echo '              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />';
                                echo '            </svg>';
                                echo '          </button>';
                                echo '        </div>';
                                echo '      </div>';
                                echo '    </div>';
                                echo '  </form>';
                                echo '</div>';
                            }
                        } else {
                            echo '
<div class="d-flex justify-content-center align-items-center" style="height: 100%;">
<p class="p-3 text-light fw-bold fw-2">No tienes solicitudes de círculos</p>
</div>';
                        }
                        ?>
                    </div>
                    <div id="contenidoSolPlanes" class="d-none">

                        <?php
                        if (count($solicitudesPlan) > 0) {
                            for ($i = 0; $i < count($solicitudesPlan); $i++) {
                                $sol = $solicitudesPlan[$i];
                                try {
                                    $cs = new Consultas();
                                    $admin = $cs->buscar($sol["Creador"], "usuario", "Nombre", "IdUsuario");
                                } catch (Exception $e) {
                                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logException.txt");
                                    header('Location: index.php?ctl=error');
                                } catch (Error $e) {
                                    error_log($e->getMessage() . microtime() . PHP_EOL, 3, "../logs/logError.txt");
                                    header('Location: index.php?ctl=error');
                                }

                                echo '<div class="rounded p-2">';
                                echo '  <form method="post" action="">';
                                echo '  <div class="bg-azul-claro d-flex p-2 rounded text-light mt-2 align-items-center">';
                                echo '    <img src="../app/archivos/img/circulos/' . $sol['FotoGrupo'] . '" class="rounded-circle imgCirculo">';
                                echo '    <div class="d-flex flex-grow-1 m-1 justify-content-between">';
                                echo '      <div class="d-flex justify-content-center flex-column">';
                                echo '        <div><span class="fw-bold">' . $sol['Nombre'] . '</span></div>';
                                echo '        <div><span class="fw-bold">' . $sol['NombreGrupo'] . '</span></div>';
                                echo '      </div>';
                                echo '      <div class="d-flex flex-column align-self-end">';
                                echo '        <button class="mb-2 btn btn-lg rounded-3 btn-warning bg-naranja text-light" name="bAceptarSolPlan" value="' . $sol['IdActividad'] . '">';
                                echo '          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">';
                                echo '            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />';
                                echo '          </svg>';
                                echo '        </button>';
                                echo '        <button class="mb-2 btn btn-lg rounded-3 btn-danger text-light" name="bRechazarSolPlan" value="' . $sol['IdActividad'] . '">';
                                echo '          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">';
                                echo '            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />';
                                echo '          </svg>';
                                echo '        </button>';
                                echo '      </div>';
                                echo '    </div>';
                                echo '  </div>';
                                echo '</form>';
                                echo '</div>';
                            }
                        } else {
                            echo '
<div class="d-flex justify-content-center align-items-center" style="height: 100%;">
<p class="p-3 text-light fw-bold fw-2">No tienes solicitudes de planes</p>
</div>';
                        }
                        ?>

                    </div>
                </div>
            <?php } ?>


        </div>


    </div>

</div>

<script src="scripts/solicitudes.js"></script>

<?php include 'layout.php' ?>