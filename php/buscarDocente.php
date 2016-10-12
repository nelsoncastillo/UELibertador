<?php
//Archivo de conexión a la base de datos
require("conexion.php");
$consultaBusqueda='';
//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {
	//Selecciona de la tabla docentes
	//donde el nombre sea igual a $consultaBusqueda, 
	$cadena = "SELECT id, nombre, cedula FROM docentes WHERE nombre LIKE '%$consultaBusqueda%' ";
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		$filas= -1;
		}else{
		//Obtiene la cantidad de filas que hay en la consulta
		$filas = pg_num_rows($resultadoc);		
		}
	}else{
		$filas= -2;
		}
	
	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {
		$mensaje = "<p>No hay ningún usuario con ese nombre y/o apellido</p>";
	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = $con->registrosArreglo($resultadoc)) {
			$nombre = $resultados['nombre'];
			$cedula = $resultados['cedula'];
			$id = $resultados['id'];
			//Output
			$mensaje .= '<p> ID: ' . $id . ' Nombre:</strong> ' . $nombre . ' Cedula: ' . $cedula . '<br></p>';

		}//Fin while $resultados

	} //Fin else $filas

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;

?>
