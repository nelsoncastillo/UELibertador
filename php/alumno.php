<?php 
include_once("conexion.php");

class Alumno
{ 
public $_id; // en tabla Id_alumno 	
public $_nombre; //en tabla Nombres
public $_apellido; //en tabla Apellidos
public $_fecha_Nacimiento; // en tabla Fecha_nacimiento 
public $_sexo; // en tabla Sexo 
public $_ci_escolar; // en tabla CIEscolar 
public $_pais; // en tabla Pais 		Pais de nacimiento
public $_estado; // en tabla Estado 		Estado de nacimiento
public $_ciudad; // en tabla Ciudad 		Ciudad de nacimiento 
public $_orden_nacimiento; // en tabla Orden_nacimiento 		Orden de nacimieto
public $_tipo_parto; // en tabla Tipo_parto 		Tipo de parto
public $_multiple_parto; // en tabla Multiple_parto 		Tipo de parto
public $_numero_parto; // en tabla Numero_parto 		Numero de Parto
public $_problemas_lenguaje; // en tabla Problemas_Lenguaje 		Problemas de Lenguaje
public $_problemas_vision; // en tabla Problema_Vision 		Problemas de Vision
public $_problemas_parto; // en tabla Problemas_Parto 		Problemas_Parto
public $_tratamiento_medico; // en tabla Tratamiento_Medico 		Tratamiento Medico
public $_tratamiento_odontologico; // en tabla Tratamiento_Odontologico 
public $_tratamiento_psicologico; // en tabla Tratamiento_Psicologico 
public $_enfermedades; // en tabla Enfermedades 
public $_control_vacunas; // en tabla Control_Vacunas 
public $_alergias; // en tabla Alergias 
public $_talla; // en tabla Talla 	
public $_peso; // en tabla Peso 
public $_responsable_primeros; // en tabla Responsable_primeros Responsable en primeros años
public $_beca; // en tabla Beca 	
public $_canaima; // en tabla Canaima

public function get_fecha_Nacimiento($id)
	{
		// si existe registro y no esta vacio devolver $_fecha_Nacimiento
		return $_fecha_Nacimiento;
	}
	
public function __construct()
	{
		// crea alumno vacio
		$this->_id=''; 	
		$this->_nombre=''; 
		$this->_apellido=''; 
		$this->_fecha_Nacimiento=''; 
		$this->_sexo=''; 
		$this->_ci_escolar=''; 
		$this->_pais=''; 
		$this->_estado=''; 
		$this->_ciudad='';
		$this->_orden_nacimiento='';
		$this->_tipo_parto='';
		$this->_multiple_parto='';
		$this->_numero_parto=''; 
		$this->_problemas_lenguaje='';
		$this->_problemas_vision=''; 
		$this->_problemas_parto=''; 
		$this->_tratamiento_medico='';
		$this->_tratamiento_odontologico=''; 
		$this->_tratamiento_psicologico=''; 
		$this->_enfermedades=''; 
		$this->_control_vacunas=''; 
		$this->_alergias=''; 
		$this->_talla=''; 
		$this->_peso=''; 
		$this->_responsable_primeros=''; 
		$this->_beca=''; 
		$this->_canaima='';
	}
	

public function _calcularEdad()
	{
		/* calculo la fecha a partir de $_fechaNacimiento */
		$diaActual = date(j);		
		$mesActual= date(n);
		$añoActual = date(Y);
		list($dia, $mes, $año) = explode("/", $this->_fecha_Nacimiento);
		// si el mes es el mismo pero el dia inferior aun
		// no ha cumplido años, le quitaremos un año al actual
			if (($mes == $mesActual) && ($dia > $diaActual)) {
			$añoActual = $añoActual - 1;
			}
		// si el mes es superior al actual tampoco habra
		// cumplido años, por eso le quitamos un año al actual
			if ($mes > $mesActual) {
			$añoActual = $añoActual - 1;
			}
		// ya no habria mas condiciones, ahora simplemente
		// restamos los años y mostramos el resultado como su edad
		$edad = $añoActual - $año;
		return $edad;
	}
				
public function get_Alumno($id){ //Validar
	// obtiene el alumno de la tabla desde id
	//si existe devuelve el objeto
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM alumnos WHERE id= $id;";
	$resultadoc = $con->consultar($cadena); 	
	if ($resultadoc) { $cont=$con->contar($resultadoc);
	}else{
		$cont =0;
	}
	if ($cont>0){
		$resulta=$con->registros($resultadoc);
		$this->_id=$resulta->id; 	
		$this->_nombre=$resulta->nombres; 
		$this->_apellido=$resulta->apellidos; 
		$this->_fecha_Nacimiento=$resulta->fecha_nacimiento; 
		$this->_sexo=$resulta->sexo; 
		$this->_ci_escolar=$resulta->ciescolar; 
		$this->_pais=$resulta->pais; 
		$this->_estado=$resulta->estado; 
		$this->_ciudad=$resulta->ciudad;
		$this->_orden_nacimiento=$resulta->orden_nacimiento;
		$this->_tipo_parto=$resulta->tipo_parto;
		$this->_multiple_parto=$resulta->multiple_parto;
		$this->_numero_parto=$resulta->numero_parto; 
		$this->_problemas_lenguaje=$resulta->problemas_lenguaje;
		$this->_problemas_vision=$resulta->problemas_vision; 
		$this->_problemas_parto=$resulta->problemas_parto; 
		$this->_tratamiento_medico=$resulta->tratamiento_medico;
		$this->_tratamiento_odontologico=$resulta->tratamiento_odontologico; 
		$this->_tratamiento_psicologico=$resulta->tratamiento_psicologico; 
		$this->_enfermedades=$resulta->enfermedades; 
		$this->_control_vacunas=$resulta->control_vacunas; 
		$this->_alergias=$resulta->alergias; 
		$this->_talla=$resulta->talla; 
		$this->_peso=$resulta->peso; 
		$this->_responsable_primeros=$resulta->responsable_primeros; 
		$this->_beca=$resulta->beca; 
		$this->_canaima=$resulta->canaima;
		return 1;
		}else{
		//si no devuelve -1
			return -1;
			}
	}
	
public function Agregar($id,$nombre,$apellido,$sexo,$ciescolar,$fecha_nacimiento,$pais,$estado,$ciudad,$orden_nacimiento,$tipo_parto,$numero_parto,$multiple_parto,$problemas_lenguaje,$problemas_vision,$problemas_parto,$tratamiento_medico, $tratamiento_odontologico,$tratamiento_psicologico,$enfermedades,$control_vacunas,$alergias,$talla,$peso,$responsable_primeros,$beca,$canaima){
	//Listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= 'INSERT INTO alumnos (id, nombres, apellidos, sexo, ciescolar, fecha_nacimiento, pais, estado, ciudad, orden_nacimiento, tipo_parto, multiple_parto, numero_parto, problemas_lenguaje, problemas_vision, problemas_parto, tratamiento_medico, tratamiento_odontologico, tratamiento_psicologico, enfermedades, control_vacunas, alergias, talla, peso, responsable_primeros, beca, canaima )';
	$cadena.= " VALUES ('$id','$nombre','$apellido','$sexo','$ciescolar','$fecha_nacimiento','$pais','$estado','$ciudad','$orden_nacimiento','$tipo_parto','$multiple_parto','$numero_parto','$problemas_lenguaje','$problemas_vision','$problemas_parto','$tratamiento_medico', '$tratamiento_odontologico','$tratamiento_psicologico','$enfermedades','$control_vacunas','$alergias','$talla','$peso','$responsable_primeros','$beca','$canaima');";
	//echo $cadena;
	// deve validar que se afecto la tabla 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla alumnos";	
	//return $resultadoc;	
		}

public function Leer($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM alumnos where id = '$id';";
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
	$cadena= "DELETE FROM alumnos WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
		}
		
public function Actualizar($id,$nombre,$apellido,$sexo,$ciescolar,$fecha_nacimiento,$pais,$estado,$ciudad,$orden_nacimiento,$tipo_parto,$numero_parto,$multiple_parto,$problemas_lenguaje,$problemas_vision,$problemas_parto,$tratamiento_medico, $tratamiento_odontologico,$tratamiento_psicologico,$enfermedades,$control_vacunas,$alergias,$talla,$peso,$responsable_primeros,$beca,$canaima){

	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE alumnos set id='$id', nombres='$nombre', apellidos='$apellido', sexo='$sexo', ciescolar='$ciescolar', fecha_nacimiento='$fecha_nacimiento', pais='$pais', estado='$estado', ciudad='$ciudad', orden_nacimiento='$orden_nacimiento', tipo_parto='$tipo_parto', multiple_parto='$multiple_parto', numero_parto='$numero_parto', problemas_lenguaje='$problemas_lenguaje', problemas_vision='$problemas_vision', problemas_parto='$problemas_parto', tratamiento_medico='$tratamiento_medico', tratamiento_odontologico='$tratamiento_odontologico', tratamiento_psicologico='$tratamiento_psicologico', enfermedades='$enfermedades', control_vacunas='$control_vacunas', alergias='$alergias', talla='$talla', peso='$peso', responsable_primeros='$responsable_primeros', beca='$beca', canaima='$canaima' ";
	$cadena.= " WHERE id='$id';";
	//echo $cadena;
	// deve validar que se afecto la tabla 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla grupos";	
	//return $resultadoc;	
		}

} 

?>
