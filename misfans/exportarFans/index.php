<?php
require_once('../../admin/cn.php');
if(isset($_POST["export"])) {
    //Define the filename with current date
    $idUser = $_POST["idUser"];
    $items = array();
    $sqlw = "SELECT b.title as 'Titulo', a.email_user as 'Correo de usuario', a.date as 'Fecha de compra', a.note_fan as 'Nota de usuario', b.question as 'Si se incluyo pregunta', a.question_answer as 'Respuesta de Fan', a.isPublic_note_fan as 'La nota es publica', b.subsciption as 'Es subscripcion' FROM payments as a INNER JOIN extras as b on b.id_extra=a.id_extra WHERE b.id_user=".$idUser." and b.active<>0";
    $resultw = $conn->query($sqlw);

    if ($resultw->num_rows > 0) {
        // output data of each row
        while($roww = $resultw->fetch_assoc()) {
            $items[] = $roww;
        }
    } else {
        //echo "0 results";
    }
    $today = date("Y-m-d H:i:s");
    $filename = 'misFans_'.$today.'.xls';
    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename");  
    header("Pragma: no-cache"); 
    header("Expires: 0");
    
    //Define the separator line
    $separator = "\t";
    
    //If our query returned rows
    if(!empty($items)){
        
        //Dynamically print out the column names as the first row in the document.
        //This means that each Excel column will have a header.
        echo implode($separator, array_keys($items[0])) . "\n";
        
        //Loop through the rows
        foreach($items as $row){
            
            //Clean the data and remove any special characters that might conflict
            foreach($row as $k => $v){
                $row[$k] = str_replace($separator . "$", "", $row[$k]);
                $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
                $row[$k] = trim($row[$k]);
            }
            
            //Implode and print the columns out using the 
            //$separator as the glue parameter
            echo implode($separator, $row) . "\n";
        }
    }
}
?>