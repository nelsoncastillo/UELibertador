<?php
include_once("usuario.php");
$usa = new Usuario;
$nomb  = $_REQUEST['txtUsuario'];
$clave = $_REQUEST['txtPass'];
if (is_null($nomb) and empty($nomb)) {
  // devolver a Inicio.html
  header('Location: ../Inicio.html');
 }
 else{
	 //si no devolvio vacios
	 if($usa->ValidarUsuario($nomb, $clave)){ 
		 //inicia la sesion
		session_start();
		//estos datos de sesion deben ser variables globales
		$_SESSION['id']  = $usa->get_id();
		$_SESSION['usuario'] = $usa->get_nombre();
		$_SESSION['tipo']   = $usa->get_tipo();
		$_SESSION['email']= $usa->get_email();
		 //deberia ejecutar la pagina de panel aqui
		 header('Location: ../panel.html');
		 }
	 else { 
		// echo "No inicio sesion"; 
		 //mensaje de error 
		 echo '<script>alert("Usuario o Clave incorrectos!");</script>';
		 //header('Location: ../Inicio.html');
		 echo '<meta http-equiv="refresh" content="1;../Inicio.html">';
		 exit();
		 //volver a cargar inicio.html
	 }
	 }
?>
