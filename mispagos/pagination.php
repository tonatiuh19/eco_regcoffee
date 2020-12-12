<?php
    require_once('../admin/cn.php');

    $limit = 10;
    
    $idUser = $_POST['username'];
    $type = $_POST['type'];

    if($type=="1"){
        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }
    
        $offset = ($page_no-1) * $limit;
    
        $sqlu = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$idUser." and a.status='completed' AND b.subsciption=0 ORDER BY a.date DESC LIMIT $offset, $limit";
    
        $resultu = $conn->query($sqlu);
    
        $output = "";
    
        if (mysqli_num_rows($resultu) > 0) {
    
        $output.='<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Status</th>
            <th scope="col">Fecha de pago a creador</th>
            <th scope="col">Cuenta</th>
          </tr>
        </thead>
        <tbody>';
            while ($rowu = $resultu->fetch_assoc()) {
                $totalAmount = $rowu["amount"]-$rowu["amount_fee"]-$rowu["amount_tax"];
                $toDeposit = $totalAmount-(($totalAmount*0.08)+($totalAmount*0.16)+2);
                $roundToDeposit = number_format((float)$toDeposit, 2, '.', '');            
                if($rowu["id_users_pay"]==null){
                    $status= '<span class="btn btn-primary p-1">En proceso</span>';
                }else if($rowu["status"]=="2"){
                    $status= '<span class="btn btn-success p-1">Completo</span>';
                }
                $output.='<tr>
                <th scope="row">'.$rowu["id_payments"].'</th>
                <td>'.$rowu["title"].'</td>
                <td>$ '.$roundToDeposit.'</td>
                <td>'.$status.'</td>
                <td>-</td>
                <td>-</td>
            </tr>';
            } 
        $output.='</tbody>
        </table>';
    
        $sqly = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$idUser." and a.status='completed' AND b.subsciption=0 ORDER BY a.date DESC";
    
        $records = $conn->query($sqly);
    
        $totalRecords = mysqli_num_rows($records);
    
        $totalPage = ceil($totalRecords/$limit);
    
        $output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";
    
        for ($i=1; $i <= $totalPage ; $i++) { 
           if ($i == $page_no) {
            $active = "active";
           }else{
            $active = "";
           }
    
            $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
        }
    
        $output .= "</ul>";
    
        echo $output;
    
        }else{
            echo '$uName';
        }

    }else{

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }
    
        $offset = ($page_no-1) * $limit;
    
        $sqlu = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$idUser." and a.status='completed' AND b.subsciption=1 ORDER BY a.date DESC LIMIT $offset, $limit";
    
        $resultu = $conn->query($sqlu);
    
        $output = "";
    
        if (mysqli_num_rows($resultu) > 0) {
    
        $output.='<table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Item</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Status</th>
            <th scope="col">Fecha de pago a creador</th>
            <th scope="col">Cuenta</th>
          </tr>
        </thead>
        <tbody>';
        
            while ($rowu = $resultu->fetch_assoc()) {
                
                $totalAmount = $rowu["amount"];
                $toDeposit = $totalAmount-(($totalAmount*0.08)+($totalAmount*0.16)+2);
                $roundToDeposit = number_format((float)$toDeposit, 2, '.', '');            
                if($rowu["id_users_pay"]==null){
                    $status= '<span class="btn btn-primary p-1">En proceso</span>';
                }else if($rowu["status"]=="2"){
                    $status= '<span class="btn btn-success p-1">Completo</span>';
                }
                $output.='<tr>
                <th scope="row">'.$rowu["id_payments"].'</th>
                <td>'.$rowu["title"].'</td>
                <td>$ '.$roundToDeposit.'</td>
                <td>'.$status.'</td>
                <td>-</td>
                <td>-</td>
            </tr>';
            } 
        $output.='</tbody>
        </table>';
    
        $sqly = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$idUser." and a.status='completed' AND b.subsciption=1 ORDER BY a.date DESC";
    
        $records = $conn->query($sqly);
    
        $totalRecords = mysqli_num_rows($records);
    
        $totalPage = ceil($totalRecords/$limit);
    
        $output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";
    
        for ($i=1; $i <= $totalPage ; $i++) { 
           if ($i == $page_no) {
            $active = "active";
           }else{
            $active = "";
           }
    
            $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
        }
    
        $output .= "</ul>";
    
        echo $output;
    
        }else{
            echo '$uName';
        }

    }

	

?>