<?php
ob_start();
ini_set('session.save_path',realpath($_SERVER['DOCUMENT_ROOT']).'/inventario_ferreteria/sessiones');
$usuario=$_POST["idusuario"];
session_start();
$_SESSION["idusu"]=$usuario;
echo $usuario;

?>
