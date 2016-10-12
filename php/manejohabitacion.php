<?php
include_once("datoshabitacion.php");

$habitacion= new DatosHabitacion;
//print_r ($habitacion);
//print " /n ";
//var_dump($habitacion);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or !isset($modo)) $modo='l';
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar llama a Ultimo() en id
 $habitacion->_id=$habitacion->Ultimo() +1 ;
 $habitacion->_estado=$_REQUEST['lstEstado']; 
 $habitacion->_municipio=$_REQUEST['lstMunicipio']; 
 $habitacion->_parroquia=$_REQUEST['lstParroquias']; 
 $habitacion->_tipo_vivienda=$_REQUEST['txtTipoVivienda']; 
 $habitacion->_zona=''; 
 if (isset($_REQUEST['ssZona']))  $habitacion->_zona=$_REQUEST['ssZona'];
//print_r ($habitacion);
$kont =$habitacion->Buscar($habitacion->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$habitacion->Agregar($habitacion->_id,$habitacion->_estado,$habitacion->_municipio,$habitacion->_parroquia,$habitacion->_tipo_vivienda,$habitacion->_zona);
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos de Habitacion '.$habitacion->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$habitacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Procedencia '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$habitacion->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$habitacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Procedencia.html para agregar registro";
		header("location:Procedencia.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($habitacion->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_habitacion_edit" action=manejohabitacion.php?modo=g" method="post" name="frm_habitacion_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Habitacion '.$habitacion->_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Estado &nbsp;</td>
<td width="194">&nbsp;<input name="lstEstado" type="text" id="lstEstado" size="27" maxlength="25" value="'.$habitacion->_estado.'"></td></tr>
<td width="100">&nbsp;&nbsp;Municipio &nbsp;</td>
<td width="194">&nbsp;<input name="lstMunicipio" type="text" id="lstMunicipio" size="27" maxlength="25" value="'.$habitacion->_municipio.'"></td></tr>
<td width="100">&nbsp;&nbsp;Parroquia &nbsp;</td>
<td width="194">&nbsp;<input name="lstParroquias" type="text" id="lstParroquias" size="27" maxlength="25" value="'.$habitacion->_parroquia.'"></td></tr>
<td width="100">&nbsp;&nbsp; Tipo de Vivienda &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtTipoVivienda" type="text" id="txtTipoVivienda" size="27" maxlength="25" value="'.$habitacion->_tipo_vivienda.'"></td></tr>
<td width="100">&nbsp;&nbsp;Zona &nbsp;</td>
<td><input name="ssZona" class="multiple_choice" id="ssZona_0" value="Rural" type="radio"><label for="ssZona_0">Rural</label>
<input name="ssZona" class="multiple_choice" id="ssZona_1" value="Urbana" type="radio"><label for="ssZona_1">Urbana</label></td></tr>
<input name="txtId" type="hidden" value="'.$habitacion->_id.'">
<input name="modo" type="hidden" id="guardar" value="g">
<TR ALIGN=center>
<TD></TD><td>
<button type="submit">Guardar</button>
</td></tr>';
			echo $strout1;
			}
		}
	}
	exit;
}

if($modo=='g'){//falta
//viene del formulario manejoprocedencias.php
 $habitacion->_id=$_REQUEST['txtId'];
 $habitacion->_estado=$_REQUEST['lstEstado']; 
 $habitacion->_municipio=$_REQUEST['lstMunicipio']; 
 $habitacion->_parroquia=$_REQUEST['lstParroquias']; 
 $habitacion->_tipo_vivienda=$_REQUEST['txtTipoVivienda']; 
 $habitacion->_zona=''; 
 if (isset($_REQUEST['ssZona']))  $habitacion->_zona=$_REQUEST['ssZona'];

//se busca:
$_id = $_REQUEST['txtId'];
	$kont =$habitacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$habitacion->Agregar($habitacion->_id,$habitacion->_estado,$habitacion->_municipio,$habitacion->_parroquia,$habitacion->_tipo_vivienda,$habitacion->_zona);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$habitacion->Actualizar($habitacion->_id,$habitacion->_estado,$habitacion->_municipio,$habitacion->_parroquia,$habitacion->_tipo_vivienda,$habitacion->_zona);
		
	}

}

if($modo=='b'){//Listo
$habitacion->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$habitacion->Buscar($habitacion->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Habitacion '.$habitacion->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center > Registro  $habitacion->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$habitacion->Cargar($habitacion->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID := $habitacion->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Estado:    $habitacion->_estado  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Municipio:  $habitacion->_municipio  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Parroquia:  $habitacion->_parroquia </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Tipo de Vivienda:  $habitacion->_tipo_vivienda</td></tr>";		
		echo '<td colspan="2"><div align="center">';
		echo " Zona:  $habitacion->_zona </td></tr></table>";
	}
}

if($modo=='s'){//seleccionar inscripcion
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("datos_habitacion");
	if(isset($_REQUEST['fuera'])){ 
		if($_REQUEST['fuera']=='s'){
			$ginscr->set_Manejador("procRegistroAlumno.phtml");
			}else{
				$ginscr->set_Manejador("procRegistroAlumno.phtml");
				}
		}else{
			$ginscr->set_Manejador("procRegistroAlumno.phtml");
			}
	
	echo $ginscr->crear_grilla($ginscr->tabla,1,'i');
	exit(); 
	} 
	
/*
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("datos_habitacion");
$ggrupo->set_Manejador("manejohabitacion.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridHabitacion.php");

?>


