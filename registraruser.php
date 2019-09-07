<?php
session_start();
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";
$conn = mysqli_connect($host, $user, $password, $database);
 $buscarUsuario = "SELECT * FROM usuarios
 WHERE username = '$_POST[username]' ";
 $sql_statement = $conn->prepare($buscarUsuario);

 $sql_statement->execute();
 $result = $sql_statement->get_result();

 if ($result->num_rows > 0) {
   echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

   echo "<a href='index.html'>Por favor escoga otro Nombre</a>";
 }
 else{

 $form_pass = $_POST['password'];

 $hash = md5($form_pass);

 $query = "INSERT INTO usuarios (name, username, email, password,estado,ciudad,fechanac)
           VALUES ('$_POST[name]', '$_POST[username]', '$_POST[email]','$hash','$_POST[estado]','$_POST[ciudad]','$_POST[fechanac]')";
 $sql_statement = $conn->prepare($query);

 if ($sql_statement->execute() === TRUE) {
  $_SESSION['user']=$_POST['username'];
  header('Location:home');
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conn->error;
 header('Location:index');
   }
 }
 $conn->Close();
?>
