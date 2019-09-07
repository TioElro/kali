<?php
include_once 'includes/user.php';
include_once 'includes/user_session.php';

$host = "localhost";
$user = "id9802464_tioelro";
$password = "hachiman09";
$database = "id9802464_db";

$conn = mysqli_connect($host, $user, $password, $database);
$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user']) && $_SESSION['user']=="admin"){
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    include_once 'addempleo.php';

}else{
    //echo "login";
    header('Location:index');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">


      function checkform() {
    // get all the inputs within the submitted form
        if(document.getElementById('puestoempleo').value==""){
          alert("Coloca el puesto del empleo");
          return false;
        }
        if(document.getElementById('message').value==""){
          alert("Escribe una descripcion del empleo");
          return false;
        }
        if(document.getElementById('cv').text==""){
          alert("Escoge requisito CV");
          return false;
        }
        if(document.getElementById('tiempo').value==""){
          alert("Escoge requisito Tiempo");
          return false;
        }
        if(document.getElementById('estado').text==""){
          alert("Escoge el estado del empleo");
          return false;
        }
        if(document.getElementById('ciudad').value==""){
          alert("Escoge la ciudad del empleo");
          return false;
        }
        if(document.getElementById('direccion').value==""){
          alert("Escribe la direccion del lugar");
          return false;
        }
        if((document.getElementById('telefono').value=="")&&(document.getElementById('correo').value=="")){
          alert("Escribe al menos un dato de contacto");
          return false;
        }
    }
    </script>
</head>
<body class="subpage">

	<header id="header">
	<h1><a href="#"><?php echo $_SESSION['user'];?>-Registro de empleos<span> en Kali</span></a></h1>
	<a href="#menu">Menú</a>
	</header>

		<!-- Nav -->
	<nav id="menu">
	<ul class="links">
	<li><a href="home">Inicio</a></li>
	<li><a href="lugaresuser">Lugares</a></li>
	<li><a href="includes/logout">Cerrar Sesión</a></li>
	</ul>
	</nav>

	<div id="main">
    <form action="registrarempleo.php" enctype="multipart/form-data" method="POST" onsubmit="return checkform()">

		<section class="wrapper style1">
					<div class="inner">
						<h2>Registro de Empleos</h2>
						<p>Puesto del Empleo: <br>
						<input type="text" id="puestoempleo" name="puestoempleo" placeholder="Ser claro con el puesto del empleo para su búsqueda"></p>

						<p>Descripción del empleo: <br>
						<textarea name="descripcion" id="message" placeholder="Descripción del empleo, trata de usar palabras claras para que los usuarios encuentren facilmente el empleo." rows="6"></textarea></p>
            <p>Porfavor selecciona los requisitos del empleo: <br>
              <div class="select-wrapper">
                  <select name="cv" id="cv">
                  <option value="">- Se requiere CV -</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                  </select>

                  <select name="tiempo" id="tiempo">
                  <option value="">- Tiempo del trabajo -</option>
                  <option value="Medio">Medio</option>
                  <option value="Completo">Completo</option>
                  </select>

              </div></p>
            <p>Direccion: <br>
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
              </div>
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
						<input type="text" id="direccion" name="direccion" placeholder="Trata de ser claro con la direccion, si es posible obtener de Maps"></p>
            <p>Contacto: <br>
						<input type="text" id="telefono" name="telefono" placeholder="Telefono">
          <input type="text" id="correo" name="correo" placeholder="Correo"></p>
            <p>Imagenes (SOLO PUEDES SUBIR 5 IMAGENES): <br>
            <input id="imagen" name="imagen[]" size="30" type="file" multiple="" /><br></p>
						<p class="center"><input type="submit" value="Registrar el Empleo"></p>
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
