<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>
<script>
function error(){
	swal("ERROR","el usuario y/o contraseña son incorrectos","error");
	}
</script>
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

       
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        
        <link rel="stylesheet" href="css/style3.css">
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
        <script src="js/sweetalert.min.js"></script>
    </head>

    <body>
<?php
if(isset($_GET['error'])){
	echo "<script>";
	echo "error();";
	echo "</script>";
	
	
	}
?>
        <p class="texto">Registro</p>
<div class="Registro">
<form method="post" action="comprueba_login.php">

<span class="fontawesome-user"></span><input type="text" name="usuario" id="usuario" required placeholder="Nombre de usuario" autocomplete="off"> 
<span class="fontawesome-lock"></span><input type="password" name="password" id="password" required placeholder="Contraseña" autocomplete="off"> 
			<input type="submit" value="Registrar" title="Registra tu cuenta">
        
        <script src="js/jQuery-2.1.4.min.js"></script>

      

    </body>

</html>
