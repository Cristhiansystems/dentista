<?php
ob_start();
ini_set('session.save_path',realpath($_SERVER['DOCUMENT_ROOT']).'/inventario_ferreteria/sessiones');
session_start();
session_destroy();
header("location:index.php");
?>
