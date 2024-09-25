<div class="d-none d-sm-block d-lg-none">
  <?php include ("menuHorizontal.php"); ?>
</div>

<div class="d-block d-sm-none">
  <?php include ("bannerMovil.php"); ?>
</div>

<div class="d-flex major">

  <?php include ("menuLateral.php"); ?>

  <div class="container">
    <div class="d-flex flex-column justify-content-center bg-azul-oscuro mt-2  p-3 rounded  principal overflow-auto">



      <div class="bg-azul-medio rounded p-2">

        <form action="" method="post" enctype="multipart/form-data">

          <label for=""></label>
          <div class="container d-flex justify-content-between my-2">
            <h2 class="txt-naranja fw-bold">Crea tu propio círculo</h2>
            <small class="text-body-secondary">Los campos con * son obligatorios</small>
          </div>

          <div class="input-group">
            <div class="form-floating m-2">
              <input type="text" class="form-control" id="nombreg" placeholder="Nombre del círculo" name="nombreg"
                required />
              <label for="nombreg">Nombre del círculo*</label>
            </div>
          </div>

          <div class="input-group">
            <div class="form-floating m-2">
              <textarea class="form-control" id="descripcion" placeholder="Descripción del círculo" name="descripcion"
                rows="10" required></textarea>
              <label for="descripcion">Descripción del círculo*</label>
            </div>
          </div>

          <label for="foto">Foto del círculo</label>
          <div class="form-floating m-2">

            <div>
              <input type="file" class="form-control rounded-3" id="foto" name="foto" />
            </div>
          </div>

          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="ccirculo"
            name="ccirculo" type="submit">Crear círculo</button>
        </form>
      </div>



    </div>


  </div>

</div>


<script src="scripts/perfil.js"></script>

<?php include 'layout.php' ?>
<script src="scripts/solicitudes.js"></script>

<?php include 'layout.php' ?>