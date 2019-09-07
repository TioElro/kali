<?php
$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";
$conn = mysqli_connect($host, $user, $password, $database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>

    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
      }

      function checkform() {
        var emailCheck = /[^a-z][0-9]/;
        var nameCheck = /[^a-z]/;
        var phoneCheck = /[0-9]/;
    // get all the inputs within the submitted form
        if(document.getElementById('name').value==""){
          alert("Escribe tu nombre completo");
          document.getElementById('name').focus();
          return false;
        }
        if(document.getElementById('username').value==""){
          alert("Escribe tu nombre de usuario");
          document.getElementById('username').focus();
          return false;
        }
        if(validateEmail(document.getElementById('email').value === false)){
          alert('No parece ser un correo');
          document.getElementById('email').focus();
          return false;
        }
        if(document.getElementById('pass').value==""){
          document.getElementById('pass').focus();
          alert("Escribe tu contraseña");
          return false;
        }
        if(document.getElementById('state').value==""){
          document.getElementById('state').focus();
          alert("Escoge tu estado");
          return false;
        }
        if(document.getElementById('city').value==""){
          document.getElementById('city').focus();
          alert("Escoge tu ciudad");
          return false;
        }
        if(document.getElementById('date').value==""){
          document.getElementById('date').focus();
          alert("Coloca tu fecha de nacimiento");
          return false;
        }
    }

    </script>
</head>
<body class="subpage">

	<header id="header">
	<h1><a href="#">Registro <span>en Kali</span></a></h1>
	<a href="#menu">Menú</a>
	</header>

		<!-- Nav -->
	<nav id="menu">
	<ul class="links">
	<li><a href="index">Inicio</a></li>
	<li><a href="login">Iniciar Sesión</a></li>
	<li><a href="lugares">Lugares</a></li>
	<li><a href="">Ayuda</a></li>
	</ul>
	</nav>

	<div id="main">
    <form action="registraruser.php" method="POST" onsubmit="return checkform()">

		<section class="wrapper style1">
					<div class="inner">
						<h2>Registro</h2>
						<p>Nombre: <br>
						<input id="name" type="text" name="name"></p>
						<p>Nombre de usuario: <br>
						<input id="username" type="text" name="username"></p>
						<p>Email: <br>
						<input id="email" type="text" name="email"></p>
						<p>Contraseña: <br>
						<input id="pass" type="password" name="password"></p>
            <p>Tu ciudad <br>
              <div class="select-wrapper">

                <?php
                  $query = "SELECT * FROM estados";
                  $sql_statement = $conn->prepare($query);
                  $sql_statement->execute();
                  $resulta = $sql_statement->get_result();
                  ?><select name="estado" id="state">
                    <option data-value="" value="">- Selecciona un Estado -</option>
                  <?php
                  if ($resulta->num_rows > 0) {
                      while ($row = $resulta->fetch_assoc()) {
                          echo '<option data-value="'.$row['id_estado'].'" value="'.$row['estado'].'">'.$row['estado'].'</option>';

                      }
                  }else{
                      echo '<option value="">No hay estados</option>';
                  }
                  ?>
                  </select>

                <select name="ciudad" id="city">
                  <option value="">- Selecciona un estado primero -</option>
                </select>
              </div></p>
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#state').on('change',function(){
                        var selected = $(this).find('option:selected');
                        var estado = selected.data('value');
                        if(estado){
                            $.ajax({
                                type:'POST',
                                url:'ajaxestados.php',
                                data:'estado='+estado,
                                success:function(html){
                                    $('#city').html(html);
                                }
                            });
                        }else{
                        }
                    });
                });
                </script>
            <p>Fecha de Nacimiento: <br>
              <input id="date" type="date" name="fechanac" value=""></p>
						<p class="center"><input type="submit" value="Ser Kalister"></p>

					</div>
				</section>

    </form>
	</div>
	<footer id="footer">
				<div class="inner">

				<div class="copyright">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-snapchat"><span class="label">Snapchat</span></a></li>
					</ul>
          &copy; Kali. Designed BY: IRRO. Images: <a href="https://unsplash.com">Coverr</a>. Video: <a href="https://coverr.co">Coverr</a>.
			</div>
			</footer>
	<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>
