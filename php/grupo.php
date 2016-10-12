<?php 
include_once("conexion.php");

class Grupo
{ 
public $_id; // en tabla  Id 	
public $_grupo; //en tabla  Grupo
public $_seccion; //en tabla Seccion 
public $_periodo; // en tabla Periodo 
public $_turno; // en tabla Turno

	public function Agregar($id,$grupo,$seccion,$periodo,$turno){//listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO grupos (id, grupo, seccion, periodo, turno) VALUES ('$id','$grupo','$seccion','$periodo','$turno')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}
		
	public function Actualizar($id,$grupo,$seccion,$periodo,$turno){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE grupos SET id='$id', grupo='$grupo', seccion='$seccion', periodo='$periodo', turno='$turno' WHERE id= '$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla grupos";	
		}
		
	public function Eliminar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM grupos WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1) echo "Error eliminando registro en tabla grupos";	
		}
		
	public function Leer($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM grupos where id = '$id';";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		return -1;
		}else{
	return $cont;			
		}
	}else{
		return -2;
		}
	
	}
	
	public function CargarGrupo($id){//listo
			$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM grupos where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->id;
	$this->_grupo=$rowc->grupo; 
	$this->_seccion=$rowc->seccion; 
	$this->_periodo=$rowc->periodo; 
	$this->_turno=$rowc->turno; 			
			}
	return 1;	
	}
		
	public function LeerTodos(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM grupos";
	print $cadena;
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		return -1;
		}else{
		//devuelve un objeto de datos
		return $con->registros($resultadoc);		
			}
		}
		
	public function AgregarAlumnosCurso($idgrupo,$idalumno,$anno,$docente,$aux){
	// esta funcion agrega una relacion de grupo, año escolar y alumno a la
	//tabla relacional cursos
	/* CREATE TABLE cursos
		(
		  "Id_grupo" integer[] NOT NULL,
		  "Id_Alumno" integer,
		  "Anno_Escolar" character varying,
		  "Id_Docente" integer,
		  "Id_Auxiliar" integer,
		  CONSTRAINT curso PRIMARY KEY ("Id_grupo" )
		)
		* */
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= 'INSERT INTO Cursos ("Id_grupo", "Id_Alumno", "Anno_Escolar","Id_Docente", "Id_Auxiliar")';
	$cadena.= ' VALUES ('.$idgrupo.', '.$idalumno.', '.$anno.','.$docente.','.$aux.');';
	$resultadoc = $con->consultar($cadena);
	
		}
		
	public function EliminarCurso($idgrupo){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM cursos WHERE Id_grupo='.$idgrupo.';";
	$resultadoc = $con->consultar($cadena); 	
		}

} 


?>



