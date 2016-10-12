<?php 
include_once("conexion.php");

class Procedencia
{ 
public  $_id; // en tabla 	Id_procedencia
public $_procedencia; //en tabla Hogar 
public $_plantel; // en tabla Hermanos_Plantel 
public $_vive_con; // en tabla   vive_con 
public $_responsable_retirar; // en tabla  Responsable_retirar
public $_cedula; // en tabla  Cedula 
public $_parentesco; // en tabla   Parentesco 	
public $_tel_local; // en tabla   Tel_local 
public $_tel_cel; // en tabla   Tlf_Celular 
public $_tel_otro; // en tabla   Otro_Telefono

	public function __construct(){
	 $this->_id=''; // en tabla 	Id_procedencia
	 $this->_procedencia=''; //en tabla Hogar 
	 $this->_plantel=''; // en tabla Hermanos_Plantel 
	 $this->_vive_con=''; // en tabla   vive_con 
	 $this->_responsable_retirar=''; // en tabla  Responsable_retirar
	 $this->_cedula=''; // en tabla  Cedula 
	 $this->_parentesco=''; // en tabla   Parentesco 	
	 $this->_tel_local=''; // en tabla   Tel_local 
	 $this->_tel_cel=''; // en tabla   Tlf_Celular 
	 $this->_tel_otro=''; // en tabla   Otro_Telefono
		// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
		$this->_id=$this->Ultimo() +1;
		}
	
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM procedencias";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		return -1;
		}else{
		$resulta=$con->registros($resultadoc);
		return $resulta->maximo;			
		}
	}else{
		return -2;
		}
	}
	
	public function Buscar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procedencias where id = '$id';";
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
	
	public function Eliminar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procedencias WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
	
	public function Agregar($id,$procedencia,$hermanos_plantel,$vive_con,$responsable_retirar,$cedula,$parentesco,$tel_local,$tel_celular,$tel_otro){//listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO procedencias (id, procedencia, hermanos_plantel,vive_con,responsable_retirar,cedula,parentesco,tel_local,tlf_celular,otro_telefono) VALUES ('$id','$procedencia','$hermanos_plantel','$vive_con','$responsable_retirar','$cedula','$parentesco','$tel_local','$tel_celular','$tel_otro')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}

	public function Actualizar($id,$procedencia,$hermanos_plantel,$vive_con,$responsable_retirar,$cedula,$parentesco,$tel_local,$tel_celular,$tel_otro){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE procedencias SET id='$id', procedencia='$procedencia', hermanos_plantel='$hermanos_plantel', vive_con='$vive_con', responsable_retirar='$responsable_retirar', cedula='$cedula', parentesco='$parentesco', tel_local='$tel_local', tlf_celular='$tel_celular', otro_telefono='$tel_otro' WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla procedencias";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procedencias where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->id;
	$this->_procedencia=$rowc->procedencia; 
	$this->_vive_con=$rowc->vive_con; 
	$this->_responsable_retirar=$rowc->responsable_retirar; 
	$this->_plantel=$rowc->hermanos_plantel;
	$this->_cedula=$rowc->cedula; 
	$this->_parentesco=$rowc->parentesco; 	
	$this->_tel_local=$rowc->tel_local; 	
	$this->_tel_cel=$rowc->tlf_celular; 			
	$this->_tel_otro=$rowc->otro_telefono; 
			}
	return 1;	
	}
		
	
} 

?>
