<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST["estado"]) && !empty($_POST["estado"])){
    //Get all state data
    $query = $db->query("SELECT * FROM municipios WHERE estado = ".$_POST['estado']."");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0){
        echo '<option value="">Selecciona una ciudad</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['nombre_municipio'].'">'.$row['nombre_municipio'].'</option>';
        }
    }else{
        echo '<option value="">No hay municipios</option>';
    }
}

?>
