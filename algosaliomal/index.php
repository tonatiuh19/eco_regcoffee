<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Hello, world!</title>
        <link href="../css/fontawesome/css/all.css" rel="stylesheet">
    </head>
    <body>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="container">
						<div class="row text-center">
							<h4 class="modal-title w-100" id="exampleModalLongTitle">
                                <div class="col-12 mb-2">
                                    <h2><span class="badge bg-danger">Algo salio mal</span></h2>
                                </div>
                                <div class="col-12 mb-2">
                                    <i class="fas fa-satellite-dish fa-3x fw-bold"></i>
                                </div>
							</h4>
						</div>
					</div>
					<div class="row text-center">
						<div class="col-12 mb-2">
                        Perdimos la conexión. Pero aún podemos recuperarla. Por favor, intenta de nuevo.
						</div>
					</div>
					<div class="row text-center">
						<div class="col-12">
							<a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Volver a probar</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </body>
    <script>
        let myModal = new bootstrap.Modal(document.getElementById("exampleModalCenter"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
    </script>
</html>