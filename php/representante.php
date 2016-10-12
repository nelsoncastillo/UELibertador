<?php 
include_once("conexion.php");

class Representantes
{ 
public $_cedula; // en tabla Cedula 	
public $_nombre; //en tabla Nombre
public $_apellido; //en tabla Apellido
public $_fecha_Nacimiento; // en tabla Nacimiento 
public $_genero; // en tabla Genero
public $_parentesco; //en tabla Parentesco
public $_pais; // en tabla Pais 		
public $_estado; // en tabla Estado 
public $_estado_civil;//en tabla Estado_civil 
public $_tel_local; // en tabla   Telefono
public $_tel_cel; // en tabla   Celular 
public $_oficio; // en tabla Oficio
public $_empresa; // en tabla Empresa
public $_tel_trabajo; // en tabla  Telefono_trabajo
public $_dir_trabajo; // en tabla Direccion_trabajo 
public $_correo; // en tabla Correo 	
public $_vive_con; // en tabla Vive  con el niñ@?
		
	public function __construct(){
	$this->_cedula='';
	$this->_nombre='';
	$this->_apellido='';
	$this->_fecha_Nacimiento='';
	$this->_genero='';
	$this->_parentesco='';
	$this->_pais='';
	$this->_estado='';
	$this->_estado_civil='';
	$this->_tel_local='';
	$this->_tel_cel='';
	$this->_oficio='';
	$this->_empresa='';
	$this->_dir_trabajo='';
	$this->_tel_trabajo='';
	$this->_correo='';
	$this->_vive_con='';
	}
	

	public function Buscar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM representantes where cedula = '$id';";
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
		
	public function Eliminar($id){ //Liisto
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM representantes WHERE cedula='$id';";
	$resultadoc = $con->consultar($cadena); 	
		}		
	
	public function get_Representante($id){ //Listo
	// obtiene el alumno de la tabla desde id
	//si existe llena el objeto
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM representantes WHERE cedula = '$id' ;";
	$resultadoc = $con->consultar($cadena); 	
	if ($resultadoc) { $cont=$con->contar($resultadoc);
	}else{
		$cont =0;
	}
	if ($cont>0){

	$resulta=$con->registros($resultadoc);
	$this->_cedula=$resulta->cedula; 	
	$this->_nombre=$resulta->nombre; 
	$this->_apellido=$resulta->apellido; 
	$this->_fecha_Nacimiento=$resulta->nacimiento; 
	$this->_genero=$resulta->genero;
	$this->_parentesco=$resulta->parentesco;
	$this->_pais=$resulta->pais;
	$this->_estado=$resulta->estado;
	$this->_estado_civil=$resulta->estado_civil;
	$this->_tel_local=$resulta->telefono;
	$this->_tel_cel=$resulta->celular;
	$this->_oficio=$resulta->oficio;
	$this->_empresa=$resulta->empresa;
	$this->_dir_trabajo=$resulta->direccion_trabajo;
	$this->_tel_trabajo=$resulta->telefono_trabajo;
	$this->_correo=$resulta->correo;
	$this->_vive_con=$resulta->vive;

		return 1;
		}else{
		//si no devuelve -1
			return -1;
			}
	}
		
public function Agregar($cedula,$nombre,$apellido,$fecha_nacimiento,$pais,$estado,$estado_civil,$genero,$parentesco,$telefono_local,$tel_cel,$oficio,$empresa,$dir_trabajo,$tel_trabajo,$correo,$vive_con){
	//Listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');

	$cadena= 'INSERT INTO representantes (cedula, nombre, apellido, nacimiento, pais, estado, estado_civil,genero, parentesco, telefono, celular, oficio, empresa, telefono_trabajo, direccion_trabajo, correo, vive )';
	$cadena.= " VALUES ('$cedula','$nombre','$apellido','$fecha_nacimiento','$pais','$estado','$estado_civil','$genero','$parentesco','$telefono_local','$tel_cel','$oficio','$empresa','$tel_trabajo','$dir_trabajo','$correo','$vive_con');";
	//echo $cadena;
	// deve validar que se afecto la tabla 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}

public function Actualizar($cedula,$nombre,$apellido,$fecha_nacimiento,$pais,$estado,$estado_civil,$genero,$parentesco,$telefono_local,$tel_cel,$oficio,$empresa,$dir_trabajo,$tel_trabajo,$correo,$vive_con){
	//Listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');

	$cadena= "UPDATE representantes
	SET cedula='$cedula', nombre= '$nombre', apellido='$apellido' , nacimiento= '$fecha_nacimiento', pais= '$pais', 
		estado='$estado' , estado_civil='$estado_civil' , genero='$genero' , parentesco='$parentesco' , 
		telefono= '$telefono_local', celular='$tel_cel' , oficio='$oficio' , empresa= '$empresa', 
		telefono_trabajo= '$tel_trabajo', direccion_trabajo= '$dir_trabajo', correo= '$correo', vive='$vive_con' ";
    $cadena.= " WHERE cedula= '$cedula';";
	
	//echo $cadena;
	// deve validar que se afecto la tabla 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}
	

} 


?>
