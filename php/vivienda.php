<?php 
include_once("conexion.php");

class Vivienda
{ 
public $_id; 
public $_tipo; 
public $_ubicacion; 
public $_nombre_ubicacion; 
public $_condiciones; 
public $_via; 
public $_nombre_via; 
public $_direccion; 
public $_telefono; 
/*
 CREATE TABLE viviendas
(
  id integer NOT NULL,
  tipo character varying, -- Anexo: _____ (Tipo)...
  ubicacion character varying, -- Barrio: ____ (Ubicacion)...
  nombre_ubicacion text,
  condiciones character varying, -- Condiciones de la vivienda...
  via text, -- Tipo de Vía: ...
  nombre_via text, -- nombre de la via
  direccion text,
  telefono text,
  CONSTRAINT pk_vivienda PRIMARY KEY (id ),
  CONSTRAINT fk_vivienda FOREIGN KEY (id)
      REFERENCES datos_habitacion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
*/
public function __construct(){
  $this->_id=''; 
  $this->_tipo=''; 
  $this->_ubicacion=''; 
  $this->_nombre_ubicacion=''; 
  $this->_condiciones=''; 
  $this->_via=''; 
  $this->_nombre_via=''; 
  $this->_direccion=''; 
  $this->_telefono=''; 
		// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
		$this->_id=$this->Ultimo() +1;
		}
	
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM viviendas";
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
	$cadena= "SELECT * FROM viviendas where id = '$id';";
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
	$cadena= "DELETE FROM viviendas WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

	public function Agregar($id,$tipo,$ubicacion,$nombre_ubicacion,$condiciones,$via,$nombre_via,$direccion,$telefono){
		//falta
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO viviendas(id, tipo, ubicacion, nombre_ubicacion, condiciones, via, nombre_via, direccion, telefono) VALUES ('$id','$tipo','$ubicacion','$nombre_ubicacion','$condiciones','$via','$nombre_via','$direccion','$telefono')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}

	public function Actualizar($id,$tipo,$ubicacion,$nombre_ubicacion,$condiciones,$via,$nombre_via,$direccion,$telefono){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE viviendas SET id=$id, tipo='$tipo', ubicacion='$ubicacion', nombre_ubicacion='$nombre_ubicacion', condiciones='$condiciones', via='$via', nombre_via='$nombre_via', direccion='$direccion', telefono='$telefono' WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla procedencias";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM viviendas where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id_=$rowc->id; 
	$this->_tipo=$rowc->tipo; 
	$this->_ubicacion=$rowc->ubicacion; 
	$this->_nombre_ubicacion=$rowc->nombre_ubicacion; 
	$this->_condiciones=$rowc->condiciones;
	$this->_via=$rowc->via; 
	$this->_nombre_via=$rowc->nombre_via; 
	$this->_direccion=$rowc->direccion; 
	$this->_telefono=$rowc->telefono; 
	
			}
	return 1;	
	}


} 

?>
