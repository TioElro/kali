<?php
session_start();
$nombre_img1 = $_FILES['imagen']['name'][0];
$nombre_img2 = $_FILES['imagen']['name'][1];
$nombre_img3 = $_FILES['imagen']['name'][2];
$nombre_img4 = $_FILES['imagen']['name'][3];
$nombre_img5 = $_FILES['imagen']['name'][4];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";

if(isset($_POST['cv']) && isset($_POST['tiempo'])){
  $cv = $_POST['cv'];
  $tiempo = $_POST['tiempo'];
}else{
  $cv = "No aplica";
  $tiempo = "No aplica";
}

$conn = mysqli_connect($host, $user, $password, $database);
 $buscarlugar = "SELECT * FROM lugares
 WHERE nombrelugar = '$_POST[nombrelugar]' AND descripcion = '$_POST[descripcion]'";
 $sql_statement = $conn->prepare($buscarlugar);

 $sql_statement->execute();
 $result = $sql_statement->get_result();

 if ($result->num_rows > 0) {
   echo "<br />". "El Empleo y Descripcion ya existen en la base de datos." . "<br />";

   echo "<a href='registrar'>Por favor escoga otros datos</a>";
 }
 else{

 $query = "INSERT INTO lugares (nombrelugar, tipolugar,subcategoria, descripcion, estado,ciudad,direccion,telefono,correo,cv,tiempo)
           VALUES ('$_POST[puestoempleo]', '10','0','$_POST[descripcion]','$_POST[estado]','$_POST[ciudad]','$_POST[direccion]','$_POST[telefono]','$_POST[correo]','$_POST[cv]','$_POST[tiempo]')";
 $sql_statement = $conn->prepare($query);
 if ((($nombre_img1 == !NULL)||($nombre_img2 == !NULL)||($nombre_img3 == !NULL)||($nombre_img4 == !NULL)||($nombre_img5 == !NULL))  && ($_FILES['imagen']['size'] <= 200000))
 {
    //indicamos los formatos que permitimos subir a nuestro servidor
    if (($_FILES["imagen"]["type"] == "image/gif")
    || ($_FILES["imagen"]["type"] == "image/jpeg")
    || ($_FILES["imagen"]["type"] == "image/jpg")
    || ($_FILES["imagen"]["type"] == "image/png"))
    {
       // Ruta donde se guardarán las imágenes que subamos
       $directorio = $_SERVER['DOCUMENT_ROOT'].'/KaliWEB/uploads/imageneslugares/';
       // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img1);
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img2);
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img3);
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img4);
       move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img5);
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
    if(($nombre_img1 == !NULL)||($nombre_img2 == !NULL)||($nombre_img3 == !NULL)||($nombre_img4 == !NULL)||($nombre_img5 == !NULL)) echo "La imagen es demasiado grande ";
 }
 $id = mysqli_insert_id($conn);



 if ($sql_statement->execute() === TRUE) {
   $query = "SELECT * FROM lugares WHERE nombrelugar='$_POST[puestoempleo]' AND tipolugar='10' AND subcategoria='0' AND descripcion='$_POST[descripcion]' AND direccion='$_POST[direccion]' AND (telefono='$_POST[telefono]' OR correo='$_POST[correo]') AND cv='$_POST[cv]' AND tiempo='$_POST[tiempo]'";
   $sql_statement = $conn->prepare($query);

   $sql_statement->execute();
   $result = $sql_statement->get_result();

   if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
         $querystar = "INSERT INTO star (lugar_id, userate, valoracion)
                  VALUES ('$row[id]', '$_SESSION[user]', '0')";
                  if ($conn->query($querystar) === TRUE) {
                    header('Location:lugaresuser');
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
