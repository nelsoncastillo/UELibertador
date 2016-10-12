<?php 
include_once("conexion.php");

class Colegio
{ 

public $_nombre; 
public $_municipio; 
public $_ciudad; 
public $_estado; 
public $_direccion; 
public $_telefonos;
public $_director; 


/*
CREATE TABLE colegio
(
  nombre character varying,
  municipio character varying,
  ciudad character varying,
  estado character varying,
  direccion character varying,
  telefonos character varying,
  director character varying
)
*/
public function __construct(){
  $this->_municipio=''; 
  $this->_ciudad=''; 
  $this->_nombre=''; 
  $this->_direccion=''; 
  $this->_telefonos=''; 
  $this->_director='';   
  $this->_estado='';
	
}
	

	public function Cargar(){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM colegio where id='1'";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla colegio";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id_=$rowc->id; 
	$this->_nombre=$rowc->nombre; 
	$this->_ciudad=$rowc->ciudad; 
	$this->_estado=$rowc->estado;
	$this->_telefonos=$rowc->telefonos; 
	$this->_municipio=$rowc->municipio; 
	$this->_direccion=$rowc->direccion; 
	$this->_director=$rowc->director;   
			}
	return 1;	
	}


} 

?>
