<?php
require_once('../admin/header.php');
?>
<div class="site-section bg-primary-light">
    <div class="container">
        <div class="row py-5">
            <div class="col-sm-12">
                <?php
                $sqls = "SELECT a.id_support, a.date, a.support_type, b.title, a.subject, a.status, a.what FROM support as a INNER JOIN support_type as b on a.support_type=b.id_support_type WHERE a.id_user=" . $_SESSION["user_param"] . "";
                $results = $conn->query($sqls);

                if ($results->num_rows > 0) {
                    echo '<table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Asunto</th>
              <th scope="col">Tipo</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>';
                    while ($rows = $results->fetch_assoc()) {
                        echo '<tr>
            <th scope="row">' . $rows["id_support"] . '</th>
            <td>' . $rows["subject"] . '</td>
            <td>' . $rows["title"] . '</td>
            <td>' . $rows["what"] . '</td>
            <td>';
                        if ($rows["status"] == "0") {
                            echo '<span class="btn btn-primary p-1">En proceso</span>';
                        } else if ($rows["status"] == "2") {
                            echo '<span class="btn btn-success p-1">Completo</span>';
                        }
                        echo '</td>
          </tr>';
                    }
                    echo '</tbody>
          </table>';
                }
                ?>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5>¿Como podemos ayudarte?</h5>
                        <form method="post" action="confirmation/">
                            <div class="mb-3">
                                <label for="exampleInputEmail1">Asunto:</label>
                                <input type="text" class="form-control" name="subject" aria-describedby="emailHelp" placeholder="" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1">¿Que tipo de problema presentas?</label>
                                <select class="form-control" name="type" required>
                                    <?php
                                    $sql = "SELECT id_support_type, title FROM support_type";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo ' <option value="' . $row["id_support_type"] . '">' . $row["title"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1">Describe detalladamente la situacion que presentas:</label>
                                <textarea class="form-control" rows="5" name="what" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php
require_once('../admin/footer.php');
$session_value = basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
    var myTitle = '<?php echo $session_value; ?>';
    document.title = 'Regalame un Cafe';

    activateNavbarItem("navAstronaut");
</script>