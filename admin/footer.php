<?php
?>
</div> <!-- .site-wrap -->

</main>
<link rel="stylesheet" href="../css/footer.css">

<footer class="footer mt-auto py-3 bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="flex-container-s">
        <div class="flex-items-s col-sm">
          <div class="col-sm">
            <h5 class="fs-5">Escribenos:</h5>
          </div>
          <a href="#" class="btn btn-outline-light">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="btn btn-outline-light">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="btn btn-outline-light">
            <i class="far fa-envelope-open"></i>
          </a>
        </div>
        <div class="flex-items-s">
          <div class="row">
            <a class="btn btn-link text-white" href="#">
              Terminos y condiciones
            </a>
          </div>
          <div class="row">
            <a class="btn btn-link text-white" href="#">
              Aviso de privacidad
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="modal fade" id="comenzar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="../sign-up/">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Ingresa tu correo electronico" required>
            <input type="hidden" id="usernametxt" name="usernametxt">
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center">Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
          ¿Ya tienes cuenta?<button class="btn btn-link" data-bs-target="#iniciarSesion" data-bs-toggle="modal" data-bs-dismiss="modal">Inicia sesion</button>
        </p>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="iniciarSesion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="../sign-in/">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email_i" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" required>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control input-lg" name="pwd_i" placeholder="Ingresa la contraseña" autocomplete="off" required>
          </div>
          <div class="form-group text-center">
            <button class="btn btn-link btn-sm" data-bs-target="#contrasenaOlvidada" data-bs-toggle="modal" data-bs-dismiss="modal">¿Olvidaste la contraseña?</button>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center">Entrar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
          ¿No tienes cuenta?<button class="btn btn-link" data-bs-target="#crearCuenta" data-bs-toggle="modal" data-bs-dismiss="modal">Crea una aqui <i class="far fa-smile-wink"></i></button>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crearCuenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="../sign-up/">
          <div class="form-group mb-2">
            <div class="input-group input-focus">
              <div class="input-group-prepend">
                <span class="input-group-text bg-white font-weight-bold">regalameuncafe.com/</span>
              </div>
              <input type="search" placeholder="tunombre" class="form-control border-left-0" name="usernametxt" id="usernameModal" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="alert alert-warning" role="alert" id="alertExistModal"><small>Este nombre de usuario ya existe :(</small></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Ingresa tu correo electronico" required>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" autocomplete="off" required>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center" id="comenzarBtnModal" disabled>Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
          ¿Ya tienes cuenta?<button class="btn btn-link" data-bs-target="#iniciarSesion" data-bs-toggle="modal" data-bs-dismiss="modal">Inicia sesion</button>
        </p>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="contrasenaOlvidada" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Olvidaste tu contraseña?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../olvidemicontrasena/">
          <div class="form-group mb-3">
            <label for="exampleInputEmail1">Escribe el correo electronico con el que te registraste:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email_o" aria-describedby="emailHelp" placeholder="" required>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark btn-sm">Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../js/coffee.js"></script>
<script src="../js/fan.js"></script>

</body>

</html>