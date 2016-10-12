<?php
include_once("RegistroAlumno.php");

$registroAlumno= new RegistroAlumno;
//print_r ($registroAlumno);
//print " /n ";
//var_dump($registroAlumno);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario procRegistroAlumno.phtml

 $registroAlumno->_alumno=$_REQUEST['txtIdAlumno']; 
 $registroAlumno->_representante=$_REQUEST['txtRepresentante'];  
 $registroAlumno->_procedencia=$_REQUEST['txtProcedencia'];  
 $registroAlumno->_vivienda=$_REQUEST['txtVivienda']; 
 $registroAlumno->_habitacion=$_REQUEST['txtDatosHabitacion']; 
//print_r ($registroAlumno);
$kont =$registroAlumno->Buscar($registroAlumno->_alumno);
//print "Contador:".$kont." \n "; 
	if ($kont<=0 ) {
		//si no existe se agrega $alumno,$representante,$procedencia,$vivienda,$habitacion)
		$registroAlumno->Agregar($registroAlumno->_alumno,$registroAlumno->_representante,$registroAlumno->_procedencia,$registroAlumno->_vivienda,$registroAlumno->_habitacion);
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro del Alumno '.$registroAlumno->_alumno.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$registroAlumno->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Alumno '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$registroAlumno->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$registroAlumno->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario procRegistroAlumno.phtml para agregar registro";
		header("location:procRegistroAlumno.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($registroAlumno->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_procRegistroAlumno_edit" action=manejoprocRegistroAlumno.php?modo=g" method="post" name="frm_procRegistroAlumno_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Registro Alumno '.$_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Alumno &nbsp;</td>
<td width="194">
<input name="txtIdAlumno" type="text" id="txtIdAlumno" size="27" maxlength="25" value="'.$registroAlumno->_alumno.'"></td></tr>

<td width="100"> Representante </td>
<td width="194">
<input name="txtRepresentante" type="text" id="txtRepresentante" size="27" maxlength="25" value="'.$registroAlumno->_representante.'"></td></tr>

<td width="100"> Procedencia </td>
<td width="194">
<input name="txtProcedencia" type="text" id="txtProcedencia" size="27" maxlength="25" value="'.$registroAlumno->_procedencia.'"></td></tr>

<td width="100"> Vivienda </td>
<td width="194">
<input name="txtVivienda" type="text" id="txtVivienda" size="27" maxlength="25" value="'.$registroAlumno->_vivienda.'" ></td></tr>

<td width="100"> Habitacion </td>
<td width="194">
<input name="txtDatosHabitacion" type="text" id="txtDatosHabitacion" size="27" maxlength="25" value="'.$registroAlumno->_habitacion.'"></td></tr>

<input name="txtId" type="hidden" value="'.$registroAlumno->_alumno.'">
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
//viene del formulario manejoprocRegistroAlumno.php
 $registroAlumno->_alumno=$_REQUEST['txtId']; 
 $registroAlumno->_representante=$_REQUEST['txtRepresentante'];  
 $registroAlumno->_procedencia=$_REQUEST['txtProcedencia'];  
 $registroAlumno->_vivienda=$_REQUEST['txtVivienda']; 
 $registroAlumno->_habitacion=$_REQUEST['txtDatosHabitacion']; 

//se busca:
$_id = $_REQUEST['txtId'];
	$kont =$registroAlumno->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$registroAlumno->Agregar($registroAlumno->_alumno,$registroAlumno->_representante,$registroAlumno->_procedencia,$registroAlumno->_vivienda,$registroAlumno->_habitacion);
		
		} else {
		//si existe mensage de ya existe
		//actualizar
		$registroAlumno->Actualizar($registroAlumno->_alumno,$registroAlumno->_representante,$registroAlumno->_procedencia,$registroAlumno->_vivienda,$registroAlumno->_habitacion);
	}

}

if($modo=='b'){//Listo
$_id= $_REQUEST['txtId'];
//se busca:
	$kont =$registroAlumno->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Alumno '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se muestra
		$registroAlumno->Cargar($_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID := $registroAlumno->_alumno ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Representante:    $registroAlumno->_representante  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Procedencia:  $registroAlumno->_procedencia  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Vivienda:  $registroAlumno->_vivienda </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Habitacion:  $registroAlumno->_habitacion </td></tr></table>";		
	}
}

if($modo=='s'){
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("procregistroalumno");
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
$ggrupo->set_tabla("procregistroalumno");
$ggrupo->set_Manejador("manejoprocRegistroAlumno.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridRegistroAlumno.php");

?>


