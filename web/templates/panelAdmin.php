<div class="d-flex justify-content-between">


<?php include("menuLateral.php"); ?>
    <div class="d-flex justify-content-end z-3">
        <div
            class="bg-azul-oscuro mt-2 me-5 rounded p-5 z-3 principal overflow-auto d-flex flex-column justify-content-center">
            <h2 class="text-light fw-bold">Panel de adminidstración</h2>

            <div class="bg-azul-medio rounded">
                <div>
                    <form action="" method="post">
                        <p class="fs-3 ms-5 mt-5 text-light pt-5">Buscar usuario</p>
                        <div class="form-floating d-flex p-5">
                            <input type="text" class="form-control rounded-3" id="buscar_usuario"
                                placeholder="Busca un usuario" name="buscar_usuario">
                            <button class="mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light p-3"
                                name="bBuscarUsuario">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                        </div>
                        <p class="fs-3 ms-5 mt-5 text-light">Buscar circulo</p>
                        <div class="form-floating d-flex p-5">
                            <input type="text" class="form-control rounded-3" id="buscar_circulo"
                                placeholder="Busca circulo" name="buscar_circulo">
                            <button class="mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light p-3"
                                name="bBuscarCirculo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>




<script src="scripts/perfil.js"></script>

<?php include 'layout.php' ?>