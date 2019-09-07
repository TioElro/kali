<?php
session_start();
$countfiles = count($_FILES['imagen']['name']);
$img1 = $_FILES['imagen']['name'][0];
$img2 = $_FILES['imagen']['name'][1];
$img3 = $_FILES['imagen']['name'][2];
$img4 = $_FILES['imagen']['name'][3];
$img5 = $_FILES['imagen']['name'][4];

$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";

$conn = mysqli_connect($host, $user, $password, $database);
 $buscarlugar = "SELECT * FROM lugares
 WHERE nombrelugar = '$_POST[nombrelugar]' AND descripcion = '$_POST[descripcion]'";
 $sql_statement = $conn->prepare($buscarlugar);

 $sql_statement->execute();
 $result = $sql_statement->get_result();

 if ($result->num_rows > 0) {
   echo "<br />". "El Nombre del lugar y descripcion ya existen en la base de datos." . "<br />";

   echo "<a href='registrar'>Por favor escoga otros datos</a>";
 }
 else{


 $query = "INSERT INTO lugares (nombrelugar, tipolugar,subcategoria, descripcion, estado,ciudad,direccion,telefono,correo,cv,tiempo,imagenruta,imagenruta2,imagenruta3,imagenruta4,imagenruta5)
           VALUES ('$_POST[nombrelugar]', '$_POST[tipolugar]','$_POST[subcategoria]','$_POST[descripcion]','$_POST[estado]','$_POST[ciudad]','$_POST[direccion]','$_POST[telefono]','$_POST[correo]'
             ,'No aplica','No aplica','$img1','$img2','$img3','$img4','$img5')";
 $sql_statement = $conn->prepare($query);
 for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES['imagen']['name'][$i];
  if ($filename == !NULL && $_FILES['imagen']['size'][$i] <= 300000)
  {

     //indicamos los formatos que permitimos subir a nuestro servidor
     if (($_FILES["imagen"]["type"][$i] != "image/gif")
     || ($_FILES["imagen"]["type"][$i] == "image/jpeg")
     || ($_FILES["imagen"]["type"][$i] == "image/jpg")
     || ($_FILES["imagen"]["type"][$i] != "image/png"))
     {
    
        // Ruta donde se guardarán las imágenes que subamos
        $directorio = $_SERVER['DOCUMENT_ROOT'].'/uploads/imageneslugares/';
        // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
        if(move_uploaded_file($_FILES['imagen']['tmp_name'][$i],$directorio.$filename)){
          echo $filename;
        }else{
          echo "No se pudo";
        }
      }
      else
      {
         //si no cumple con el formato
         echo "No se puede subir una imagen con ese formato ";
      }
  }
  else
  {
     //si existe la variable pero se pasa del tamaño permitido
     if($filename == !NULL) echo "La imagen es demasiado grande ";
  }

  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'upload/'.$filename);

 }

 $id = mysqli_insert_id($conn);



 if ($sql_statement->execute() === TRUE) {
   $query = "SELECT * FROM lugares WHERE nombrelugar='$_POST[nombrelugar]' AND tipolugar='$_POST[tipolugar]' AND subcategoria='$_POST[subcategoria]' AND descripcion='$_POST[descripcion]' AND direccion='$_POST[direccion]' AND (telefono='$_POST[telefono]' OR correo='$_POST[correo]')";
   $sql_statement = $conn->prepare($query);

   $sql_statement->execute();
   $result = $sql_statement->get_result();

   if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
         $querystar = "INSERT INTO star (lugar_id, userate, valoracion)
                  VALUES ('$row[id]', '$_SESSION[user]', '0')";
                  if ($conn->query($querystar) === TRUE) {
                  } else {
                    echo "Error al crear el lugar." . $query . "<br>" . $conn->error;
                  }
       }
   }

 }

 else {
 echo "Error al crear el lugar." . $query . "<br>" . $conn->error;
 header('Location:añadirlugar');
   }
 }
?>
