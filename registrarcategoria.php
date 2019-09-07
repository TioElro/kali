<?php
session_start();
$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
$ruta="images";
$ruta=$ruta."/".$nombre_img;
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";

$conn = mysqli_connect($host, $user, $password, $database);
 $buscarlugar = "SELECT * FROM subcategorias
 WHERE categoria = '$_POST[tipolugar]' AND subcategoria = '$_POST[nombresub]'";
 $sql_statement = $conn->prepare($buscarlugar);

 $sql_statement->execute();
 $result = $sql_statement->get_result();

 if ($result->num_rows > 0) {
   echo "<br />". "El Nombre del lugar y descripcion ya existen en la base de datos." . "<br />";

   echo "<a href='registrar'>Por favor escoga otros datos</a>";
 }
 else{

     $query = "SELECT * FROM subcategorias WHERE categoria = '$_POST[tipolugar]'";
     $sql_statement = $conn->prepare($query);
     $sql_statement->execute();
     $resulta = $sql_statement->get_result();
     $idsub=$resulta->num_rows;
     $idsub=$idsub+1;


 $query = "INSERT INTO subcategorias (idsub, categoria,subcategoria, rutaimagen)
           VALUES ('$idsub','$_POST[tipolugar]','$_POST[nombresub]','$nombre_img')";
 $sql_statement = $conn->prepare($query);
 if ($nombre_img == !NULL && $_FILES['imagen']['size'] <= 200000)
 {
    //indicamos los formatos que permitimos subir a nuestro servidor
    if (($_FILES["imagen"]["type"] != "image/gif")
    || ($_FILES["imagen"]["type"] == "image/jpeg")
    || ($_FILES["imagen"]["type"] == "image/jpg")
    || ($_FILES["imagen"]["type"] != "image/png"))
    {

       // Ruta donde se guardarán las imágenes que subamos
       $directorio = $_SERVER['DOCUMENT_ROOT'].'/uploads/imagenessubcat/';
       // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
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
    if($nombre_img == !NULL) echo "La imagen es demasiado grande ";
 }
 $id = mysqli_insert_id($conn);



 if ($sql_statement->execute() === TRUE) {
   $query = "SELECT * FROM subcategorias WHERE idsub='$idsub' AND categoria='$_POST[tipolugar]' AND subcategoria='$_POST[nombresub]' AND rutaimagen='$nombre_img'";
   $sql_statement = $conn->prepare($query);

   $sql_statement->execute();
   $result = $sql_statement->get_result();

   if ($result->num_rows > 0) {
      header('Location:lugaresuser');
   }else{
     echo "Error al crear la categoria";
   }

 }

 else {
   echo "Error al crear la categoria";
 header('Location:añadircategoria');
   }
 }
?>
