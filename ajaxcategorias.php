<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST["categoria"]) && !empty($_POST["categoria"])){
    //Get all state data
    $query = $db->query("SELECT * FROM subcategorias WHERE categoria = ".$_POST['categoria']."");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){
        echo '<option value="">Selecciona una subcategoria</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['idsub'].'">'.$row['subcategoria'].'</option>';
        }
    }else{
        echo '<option value="">No hay subcategorias</option>';
    }
}

?>
