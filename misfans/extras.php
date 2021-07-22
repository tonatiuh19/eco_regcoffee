<?php
require_once('../admin/cn.php');
session_start();
date_default_timezone_set('America/Mexico_City');
$limit = 10;

$idExtra = $_POST['extraid'];
$uName = $_SESSION['uname'];;

if (isset($_POST['page_no'])) {
    $page_no = $_POST['page_no'];
} else {
    $page_no = 1;
}

$offset = ($page_no - 1) * $limit;

$sqlu = "SELECT a.id_payments, a.id_extra, a.id_conekta, a.date, b.price, a.description, a.question_answer, a.email_user, a.isPublic_note_fan, a.note_fan, b.active, b.title, b.subsciption FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE (a.status='paid' or a.status='pending') and a.id_extra=" . $idExtra . " order by a.date desc LIMIT $offset, $limit";

$resultu = $conn->query($sqlu);

$output = "";

if (mysqli_num_rows($resultu) > 0) {
    $sql = "SELECT active, subsciption, title, question FROM extras WHERe id_extra=" . $idExtra . "";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            
            if ($row["active"] == "4") {
                $output .= '<table class="table table-bordered"> 
                  <thead class="thead-dark"> 
                    <tr> 
                      <th scope="col">#</th> 
                      <th scope="col">Tipo de mensaje</th> 
                      <th scope="col" class="w-30">Mensaje</th> 
                      <th scope="col"># de Cafes</th> 
                      <th scope="col">Total $</th>  
                      <th scope="col">Fecha</th>
                    </tr> 
                  </thead> 
                <tbody>';
            } else {
                if ($row["question"] == "") {
                    $output .= '<table class="table table-bordered"> 
                      <thead class="thead-dark"> 
                        <tr> 
                          <th scope="col">#</th> 
                          <th scope="col">Tipo de mensaje</th> 
                          <th scope="col" class="w-30">Mensaje</th> 
                          <th scope="col">Total $</th>  
                          <th scope="col">Fecha</th>
                          <th scope="col">Completar</th> 
                        </tr> 
                      </thead> 
                    <tbody>';
                } else {
                    $output .= '<table class="table table-bordered"> 
                      <thead class="thead-dark">
                        <tr> 
                          <th scope="col">#</th> 
                          <th scope="col">Tipo de mensaje</th> 
                          <th scope="col" class="w-30">Mensaje</th> 
                          <th scope="col">Respuesta a pregunta</th> 
                          <th scope="col">Total $</th>  
                          <th scope="col">Fecha</th>
                          <th scope="col">Completar</th> 
                        </tr> 
                      </thead> 
                    <tbody>';
                }
            }
        }
    }

    $x = 0;
    while ($rowu = $resultu->fetch_assoc()) {
        $x++;
        $date = date_create($rowu["date"]);
        $mysqltime = date_format($date, 'd-m-Y G:i a');

        if ($rowu["active"] == "4") {
            $whatIWant = substr($rowu["description"], strpos($rowu["description"], "|") + 1);
            if ($rowu["isPublic_note_fan"] == "1") {
                $isPublic = '<span class="bg-dark text-white">&nbsp;Privado&nbsp;</span>';
                $output .= '<tr class="">';
            } else {
                $isPublic = '<span class="bg-success text-white">&nbsp;Publico&nbsp;</span>';
                $output .= '<tr>';
            }

            if ($rowu["note_fan"] == "") {
                $nota = "Sin mensaje.";
            } else {
                $nota = $rowu["note_fan"];
            }

            $output .= '
                    <th scope="row">' . $x . '</th>
                    <td>' . $isPublic . '</td>
                    <td>' . $nota . '</td>
                    <td>' . $whatIWant . '</td>
                    <td>$ ' . $rowu["price"] . '</td>
                    <td>' . $mysqltime . '</td>
                </tr>';
        } else {
            if ($rowu["isPublic_note_fan"] == "1") {
                $isPublic = '<span class="bg-dark text-white">&nbsp;Privado&nbsp;</span>';
                $output .= '<tr class="bg-light">';
            } else {
                $isPublic = '<span class="bg-success text-white">&nbsp;Publico&nbsp;</span>';
                $output .= '<tr>';
            }

            if ($rowu["note_fan"] == "") {
                $nota = "Sin mensaje.";
            } else {
                $nota = $rowu["note_fan"];
            }

            if ($rowu["question_answer"] == "") {
                $respuesta = "";
            } else {
                $respuesta = '<td>' . $rowu["question_answer"] . '</td>';
            }

            $sqlm = "SELECT id_payments_complete FROM payments_complete WHERE id_payments=" . $rowu["id_payments"] . "";
            $resultm = $conn->query($sqlm);

            if ($resultm->num_rows > 0) {
                // output data of each row
                $complet = '<td><button type="button" class="btn btn-primary btn-sm text-white disabled">Completo</button></td>';
            } else {
                $complet = '<td><button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#completar' . $rowu["id_payments"] . '">Completar <i class="fas fa-check"></i></button>';
            }
            $output .= '
                    <th scope="row">' . $x . '</th>
                    <td>' . $isPublic . '</td>
                    <td>' . $nota . '</td>
                    ' . $respuesta . '
                    <td>$ ' . $rowu["price"] . '</td>
                    <td>' . $mysqltime . '</td>
                    ' . $complet . '
                </tr>';
        }
        echo '<div class="modal fade" id="completar' . $rowu["id_payments"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                <h3>¿Esta completo?</h3>
                  <form action="completeExtra/" method="post" id="finish">
                  <input type="hidden" name="idExtra" value="' . $rowu["id_extra"] . '">
                  <input type="hidden" name="email" value="' . $rowu["email_user"] . '">
                  <input type="hidden" name="idPayment" value="' . $rowu["id_payments"] . '">
                  <input type="hidden" name="subs" value="' . $rowu["subsciption"] . '">
                  <br>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-success text-white"><i class="fas fa-check"></i> Completar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>';
    }
    $idUser = $_SESSION["user_param"];
    $output .= '</tbody> </table><div class="row justify-content-end">
    <form action="./exportarFans/" method="post">
      
      <input type="hidden" name="idUser" value="' . $idUser . '">

      <button type="submit" id="export" name="export" value="Export to excel" class="btn btn-success text-white"><i class="fas fa-file-excel"></i> Exportar a Excel</button>
    </form>
  </div>';



    $sqly = "SELECT a.id_conekta, a.date, b.price, a.description, a.question_answer, a.isPublic_note_fan, a.note_fan, b.active FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra WHERE (a.status='paid' or a.status='pending') and a.id_extra=" . $idExtra . "";

    $records = $conn->query($sqly);

    $totalRecords = mysqli_num_rows($records);

    $totalPage = ceil($totalRecords / $limit);

    $output .= "<ul class='pagination justify-content-center bBottom' style='margin:20px 0'>";

    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i == $page_no) {
            $active = "active";
        } else {
            $active = "";
        }

        $output .= "<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
    }

    $output .= "</ul>";

    echo $output;
} else {
    $sql = "SELECT active, subsciption, title FROM extras WHERe id_extra=" . $idExtra . "";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["active"] == "4") {
                echo '<div class="container-center">
                <div class="flex-container-center">
                  <div class="row-center">
                    <div class="flex-item-center">
                      <div class="p-5 mb-4 rounded-3">
                        <div class="container-fluid py-5">
                          <h1 class="display-5 fw-bold">
                            Aun no te regalan cafes <i class="far fa-dizzy"></i>
                          </h1>
                          <p class="col-md-8 fs-4">
                          <h2 class="mb-4 section-heading">Aqui tienes algunos tips:</h2>
                          <ul class="list-unstyled mb-3">
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en redes sociales.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en Youtube.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu read-me en tus repositorios de Git.</li>
                              <li> <i class="far fa-hand-point-right"></i> Incluye tu link en todos lados! donde lo necesites <i class="fas fa-heart text-danger"></i>.</li>
                          </ul>
                          </p>
                          
                          <a href="#generarBoton" class="btn btn-primary"><i class="fas fa-code"></i> Crea un boton</a>
                          <a href="#generarBoton" class="btn btn-primary">Añade extras</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
            } else {
                if ($row["subsciption"] == "1") {
                    echo '<div class="container-center">
                <div class="flex-container-center">
                  <div class="row-center">
                    <div class="flex-item-center">
                      <div class="p-5 mb-4 rounded-3">
                        <div class="container-fluid py-5">
                          <h1 class="display-5 fw-bold">
                          Aun no se suscriben a ' . $row["title"] . '<i class="far fa-dizzy"></i>
                          </h1>
                          <p class="col-md-8 fs-4">
                          <h2 class="mb-4 section-heading">Aqui tienes algunos tips:</h2>
                          <ul class="list-unstyled mb-3">
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en redes sociales.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en Youtube.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu read-me en tus repositorios de Git.</li>
                              <li> <i class="far fa-hand-point-right"></i> Incluye tu link en todos lados! donde lo necesites <i class="fas fa-heart text-danger"></i>.</li>
                          </ul>
                          </p>
                          
                          <a href="#generarBoton" class="btn btn-primary"><i class="fas fa-code"></i> Crea un boton</a>
                          <a href="#generarBoton" class="btn btn-primary">Comparte tu link</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
                } else {
                    echo '<div class="container-center">
                <div class="flex-container-center">
                  <div class="row-center">
                    <div class="flex-item-center">
                      <div class="p-5 mb-4 rounded-3">
                        <div class="container-fluid py-5">
                          <h1 class="display-5 fw-bold">
                          Aun no te compran ' . $row["title"] . '<i class="far fa-dizzy"></i>
                          </h1>
                          <p class="col-md-8 fs-4">
                          <h2 class="mb-4 section-heading">Aqui tienes algunos tips:</h2>
                          <ul class="list-unstyled mb-3">
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en redes sociales.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en Youtube.</li>
                              <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu read-me en tus repositorios de Git.</li>
                              <li> <i class="far fa-hand-point-right"></i> Incluye tu link en todos lados! donde lo necesites <i class="fas fa-heart text-danger"></i>.</li>
                          </ul>
                          </p>
                          
                          <a href="#generarBoton" class="btn btn-primary"><i class="fas fa-code"></i> Crea un boton</a>
                          <a href="#generarBoton" class="btn btn-primary">Comparte tu link</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
                }
            }
        }
    } else {
        echo "0 results";
    }
}
