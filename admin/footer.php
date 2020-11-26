<?php
?>
    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="footer-heading mb-4">About</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi cumque tenetur inventore veniam, hic vel ipsa necessitatibus ducimus architecto fugiat!</p>
            <div class="my-5">
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Symptoms</a></li>
                  <li><a href="#">Prevention</a></li>
                  <li><a href="#">FAQs</a></li>
                  <li><a href="#">About Coronavirus</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Helpful Link</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Helathcare Professional</a></li>
                  <li><a href="#">LGU Facilities</a></li>
                  <li><a href="#">Protect Your Family</a></li>
                  <li><a href="#">World Health</a></li>
                </ul>
              </div>
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">Resources</h2>
                <ul class="list-unstyled">
                  <li><a href="#">WHO Website</a></li>
                  <li><a href="#">CDC Website</a></li>
                  <li><a href="#">Gov Website</a></li>
                  <li><a href="#">DOH Website</a></li>
                </ul>
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
        <form method="post" action="sign-in/">
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
        <form method="post" action="sign-up/">
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
            ¿Ya tienes cuenta? <a href="#">Inicia sesion</a>
        </p>
      </div>
    </div>
  </div>
</div>
</body>
</html>