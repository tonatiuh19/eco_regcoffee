<?php
?>
    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            
            <?php
            if(isset($_SESSION["user_param"])) 
            {
              echo '<h2 class="footer-heading mb-4">¿Te gusta el contenido de <b>'.$uName.'?</b></h2>
              <p>Comparte y apoya:</p>
              <a href="#" class="btn btn-warning">Compartir Link</a>
              ';
            }else{
              echo '<h2 class="footer-heading mb-4">Escribenos:</h2>
              <p><a href="mailto:dihola@regalameuncafe.com">dihola@regalameuncafe.com</a></p>
              <div class="my-5">
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>';
            }
            ?>
          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-4">
              &nbsp;
              </div>
              <div class="col-lg-4">
              &nbsp;
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4"></h2>
                <ul class="list-unstyled">
                  <li><a href="#">Terminos y condiciones</a></li>
                  <li><a href="#">Politicas de privacidad</a></li>
                  <li><a href="#">Empleo</a></li>
                  <li><a href="#">FAQ</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p class="copyright"><small>
                Hecho con <i class="icon-heart text-danger" aria-hidden="true"></i> para Mexico y Latinoamerica.
               </small></p>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div> <!-- .site-wrap -->

  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/jquery.countdown.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/jquery.fancybox.min.js"></script>
  <script src="../js/jquery.sticky.js"></script>
  <script src="../js/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
  <script src="../js/jquery.formatCurrency-1.4.0.js"></script>

  <script src="../js/main.js"></script>
  <script src="../js/coffee.js"></script>
  <script src="../js/fan.js"></script>

  <div class="modal fade" id="iniciarSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Entrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../sign-in/">
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email_i" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" name="pwd_i" placeholder="Ingresa la contraseña" required> 
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center">Entrar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
          ¿No tienes cuenta? <a href="" onclick="openRegister();return false;">Crea una aqui <i class="far fa-smile-wink"></i></a>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crearCuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../sign-up/">
          <div class="form-group">
            <div class="input-group input-focus">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white font-weight-bold">regalameuncafe.com/</span>
                </div>
                <input type="search" placeholder="tunombre" class="form-control border-left-0" name="usernametxt" id="usernameModal" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="alert alert-warning" role="alert" id="alertExistModal"><small>Este nombre de usuario ya existe :(</small></div>
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" name="email" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" required>
            
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" name="password" placeholder="Ingresa una contraseña" required> 
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center" id="comenzarBtnModal" disabled>Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        <p class="text-center">
            ¿Ya tienes cuenta? <a href="" onclick="openInicio();return false;">Inicia sesion</a>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="crearCuentaCreador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Genera ingresos con tu creatividad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../nuevoCreador/">
          <div class="form-group">
            <div class="input-group input-focus">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-white font-weight-bold">regalameuncafe.com/</span>
                </div>
                <input type="search" placeholder="tunombre" class="form-control border-left-0" name="usernametxt" id="usernameModalCreator" autofocus="autofocus" autocomplete="off">
            </div>
            <div class="alert alert-warning" role="alert" id="alertExistModalCreator"><small>Este nombre de usuario ya existe :(</small></div>
            <br>
            <small id="emailHelp" class="form-text text-muted">Igual podras seguir apoyando a tus favoritos <i class="far fa-hand-peace"></i></small>
          </div>
        
          <div class="form-group text-center">
            <button type="submit" class="btn btn-dark text-center" id="comenzarBtnModalCreator" disabled>Continuar <i class="fas fa-arrow-circle-right"></i></button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

</body>
</html>