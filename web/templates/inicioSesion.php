<div class="bg-crudo d-flex align-items-center justify-content-center divInicio">

  <div id="login" class="d-flex align-items-center justify-content-around p-5">
    <div id="logoPalsPlans" class="d-none d-xxl-block">
      <img src="../app/archivos/img/logos/logo-no-background.png" class="imgInicio me-5 ">
    </div>
    <div id="cajaInicio" class="bg-azul-medio rounded-3">
      <div class="modal-header p-3">
        <h1 class="fw-bold mb-0 fs-2 text-light">Inicio de Sesión</h1>
      </div>
      <div class="modal-body p-3 pt-0">
        <form method="post" action="">
          <div class="form-floating">
            <input type="email" class="form-control rounded-3" id="mail" placeholder="name@example.com" name="mail"
              required>
            <label for="email">Correo Electrónico</label>
          </div>

          <div id="mailMal" class="mb-3 text-danger"></div>

          <div class="form-floating">
            <input type="password" class="form-control rounded-3" id="pass" placeholder="Password" name="pass" required>
            <label for="pass">Contraseña</label>
          </div>

          <div id="passMal" class="mb-3 text-danger"></div>

          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning mt-2 bg-naranja text-light" type="submit"
            id="bLogin" name="bLogin">Iniciar Sesión</button>
        </form>

        <small class="text-body-secondary ">Si todavía no tienes una cuenta, registrate aquí</small>
        <button id="bReg" class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" type="submit"
          name="bReg">Registrarse</button>
      </div>
    </div>
  </div>

  <div id="reg" class="d-none bg-azul-medio rounded p-3 flex-column overflow-auto">
    <form action="" method="post" enctype="multipart/form-data">

      <div class="container d-block d-xl-flex justify-content-between my-2">
        <img src="../app/archivos/img/logos/logo-no-background.png" class="logoTexto d-none d-xl-block">
        <small class="text-body-secondary">Los campos con * son obligatorios</small>
      </div>

      <div class="input-group">
        <div class="form-floating m-2">
          <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required />
          <label for="nombre">Nombre de usuario*</label>
        </div>
      </div>

      <div class="form-floating m-2">
        <input type="email" class="form-control rounded-3" id="mail" placeholder="name@example.com" name="mail"
          required />
        <label for="mail">Correo Electrónico*</label>
      </div>

      <div class="form-floating m-2">
        <input type="password" class="form-control rounded-3" id="pass" placeholder="Password" name="pass" required />
        <label for="pass">Contraseña*</label>
      </div>

      <div class="mb-3 mx-5-md mx-5-lg">
        La contraseña debe contener: <span id="mayus" class="">1 Mayúscula</span>, <span id="minus" class="">1
          minúscula</span>, <span id="num" class="">1 número</span>, <span id="especial" class="">1 carácter
          especial</span>.
        <span id="longitud" class="">Entre 8 y 16 caracteres</span>
      </div>

      <div class="form-floating m-2">
        <input type="password" class="form-control rounded-3" id="pass2" placeholder="Password" name="pass2" required />
        <label for="pass2">Repita Contraseña*</label>
      </div>

      <div class="form-floating m-2">
        <input type="date" class="form-control rounded-3" id="fecha" placeholder="Password" name="fecha" required />
        <label for="fecha">Fecha de Nacimiento*</label>
      </div>

      <label for="descripcion">Descripción</label>
      <div class="form-floating m-2">
        <textarea class="form-control rounded-3" id="descripcion" name="descripcion" rows="5"></textarea>
        <label for="descripcion">Añade tu descripcion</label>
      </div>

      <label for="foto">Foto de perfil</label>
      <div class="form-floating m-2">
        <div>
          <input type="file" class="form-control rounded-3" id="foto" name="foto" />
        </div>
      </div>

      <button class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" id="bReg2" name="bReg2"
        type="submit">Registrarse</button>
    </form>

    <div>
      <small class="text-body-secondary ">Si ya tienes una cuenta, inicia sesión aquí</small>
      <button id="bLogin2" class="w-100 mb-2 btn btn-lg rounded-3 btn-warning  bg-naranja text-light" type="submit"
        name="bLogin2">Iniciar sesión</button>
    </div>

  </div>
</div>

<script src="scripts/inicio_sesion.js"></script>
<?php include 'layout.php' ?>