<?php
require_once('../admin/header.php');
?>
    <div class="site-section bg-primary-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">

            <div class="row"></div>
            <div class="row">
              <div class="col-6 col-lg-6 mt-lg-5">
                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-stay-at-home"></span>
                  </div>
                  <div class="body">
                    <h3>Stay at home</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>

                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-patient"></span>
                  </div>
                  <div class="body">
                    <h3>Wear facemask</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>
              </div>
              <div class="col-6 col-lg-6">
                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-social-distancing"></span>
                  </div>
                  <div class="body">
                    <h3>Keep social distancing</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>

                <div class="media-v1 bg-1">
                  <div class="icon-wrap">
                    <span class="flaticon-hand-washing"></span>
                  </div>
                  <div class="body">
                    <h3>Wash your hands</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, debitis!</p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="section-heading mb-4">How to Prevent Coronavirus?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis doloribus consequatur fugit voluptatum ex rerum perspiciatis cupiditate, esse hic!</p>
            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, error!</p>

            <ul class="list-check list-unstyled mb-5">
              <li>Lorem ipsum dolor sit amet</li>
              <li>Consectetur adipisicing elit</li>
              <li>Unde doloremque</li>
            </ul>

            <p><a href="#" class="btn btn-primary">Read more about prevention</a></p>
          </div>
        </div>
      </div>
    </div>

<?php
require_once('../admin/footer.php');
$session_value=basename(dirname(__FILE__));
?>
<script type="text/javascript">
	var myTitle='<?php echo $session_value;?>';
	document.title = 'Regalame un Cafe';
</script>