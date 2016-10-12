<?php
include_once("procedencia.php");

$procedencia= new Procedencia;
//print_r ($procedencia);
//print " /n ";
//var_dump($procedencia);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or !isset($modo)) $modo='l';
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar llama a Ultimo() en id
 $procedencia->_id=$procedencia->Ultimo() +1 ; // en tabla 	Id_procedencia
 $procedencia->_plantel=$_REQUEST['txtHermanoPlantel']; // en tabla Hermanos_Plantel 
 $procedencia->_vive_con=$_REQUEST['txtViveCon']; // en tabla   vive_con 
 $procedencia->_responsable_retirar=$_REQUEST['txtReponsableRetirarlo']; // en tabla  Responsable_retirar
 $procedencia->_cedula=$_REQUEST['txtCedula']; // en tabla  Cedula 
 $procedencia->_parentesco=$_REQUEST['txtParentesco']; // en tabla   Parentesco 	
 $procedencia->_tel_local=$_REQUEST['txtTelefonolocal']; // en tabla   Tel_local 
 $procedencia->_tel_cel=$_REQUEST['txtCelular']; // en tabla   Tlf_Celular 
 $procedencia->_tel_otro=$_REQUEST['txtOtroTelefono']; // en tabla   Otro_Telefono
 $procedencia->_procedencia="No definido";
 if (isset($_REQUEST['ssProcede']))  $procedencia->_procedencia=$_REQUEST['ssProcede'];
//print_r ($procedencia);
$kont =$procedencia->Buscar($procedencia->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$procedencia->Agregar($procedencia->_id,$procedencia->_procedencia,$procedencia->_plantel,$procedencia->_vive_con,$procedencia->_responsable_retirar,$procedencia->_cedula,$procedencia->_parentesco,$procedencia->_tel_local,$procedencia->_tel_cel,$procedencia->_tel_otro);
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Procedencia '.$procedencia->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$procedencia->Buscar($_id);
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
		$procedencia->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$procedencia->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Procedencia.html para agregar registro";
		header("location:Procedencia.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($procedencia->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_procedencia_edit" action=manejoprocedencia.php?modo=g" method="post" name="frm_procedencia_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Procedencia '.$procedencia->_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Procedencia &nbsp;</td>
<td><input name="ssProcede" class="multiple_choice" id="ssProcede_0" value="Hogar" type="radio"><label for="ssProcede_0">Hogar</label>
<input name="ssProcede" class="multiple_choice" id="ssProcede_1" value="Guarderia" type="radio"><label for="ssProcede_1">Guarderia</label>
<input name="ssProcede" class="multiple_choice" id="ssProcede_2" value="Otro" type="radio"><label for="ssProcede_2">Otro</label></td></tr>
<td width="100">&nbsp;&nbsp;Hermanos en el Plantel &nbsp;</td>
<td width="194">&nbsp;<input name="txtHermanoPlantel" type="text" id="txtHermanoPlantel" size="27" maxlength="25" value="'.$procedencia->_plantel.'"></td></tr>
<td width="100">&nbsp;&nbsp; Vive Con &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtViveCon" type="text" id="txtViveCon" size="27" maxlength="25" value="'.$procedencia->_vive_con.'"></td></tr>
<td width="100">&nbsp;&nbsp; Responsable de Retirarlo &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtReponsableRetirarlo" type="text" id="txtReponsableRetirarlo" size="27" maxlength="25" value="'.$procedencia->_responsable_retirar.'" ></td></tr>
<td width="100">&nbsp;&nbsp; Cedula de Responsable &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtCedula" type="text" id="txtCedula" size="27" maxlength="25" value="'.$procedencia->_cedula.'"></td></tr>
<td width="100">&nbsp;&nbsp; Parentesco &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtParentesco" type="text" id="txtParentesco" size="27" maxlength="25" value="'.$procedencia->_parentesco.'"></td></tr>
<td width="100">&nbsp;&nbsp; Telefono Local &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtTelefonolocal" type="text" id="txtTelefonolocal" size="27" maxlength="25" value="'.$procedencia->_tel_local.'"></td></tr>
<td width="100">&nbsp;&nbsp; Telefono Celular &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtCelular" type="text" id="txtCelular" size="27" maxlength="25" value="'.$procedencia->_tel_cel.'"></td></tr>
<td width="100">&nbsp;&nbsp; Otro Telefono &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtOtroTelefono" type="text" id="txtOtroTelefono" size="27" maxlength="25" value="'.$procedencia->_tel_otro.'"></td></tr>
<input name="txtId" type="hidden" value="'.$procedencia->_id.'">
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
 $procedencia->_id= $_REQUEST['txtId']; // en tabla 	Id_procedencia
 $procedencia->_plantel=$_REQUEST['txtHermanoPlantel']; // en tabla Hermanos_Plantel 
 $procedencia->_vive_con=$_REQUEST['txtViveCon']; // en tabla   vive_con 
 $procedencia->_responsable_retirar=$_REQUEST['txtReponsableRetirarlo']; // en tabla  Responsable_retirar
 $procedencia->_cedula=$_REQUEST['txtCedula']; // en tabla  Cedula 
 $procedencia->_parentesco=$_REQUEST['txtParentesco']; // en tabla   Parentesco 	
 $procedencia->_tel_local=$_REQUEST['txtTelefonolocal']; // en tabla   Tel_local 
 $procedencia->_tel_cel=$_REQUEST['txtCelular']; // en tabla   Tlf_Celular 
 $procedencia->_tel_otro=$_REQUEST['txtOtroTelefono']; // en tabla   Otro_Telefono
 $procedencia->_procedencia="No definido";
 if (isset($_REQUEST['ssProcede']))  $procedencia->_procedencia=$_REQUEST['ssProcede'];

//se busca:
$_id = $_REQUEST['txtId'];
	$kont =$procedencia->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$procedencia->Agregar($procedencia->_id,$procedencia->_procedencia,$procedencia->_plantel,$procedencia->_vive_con,$procedencia->_responsable_retirar,$procedencia->_cedula,$procedencia->_parentesco,$procedencia->_tel_local,$procedencia->_tel_cel,$procedencia->_tel_otro);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$procedencia->Actualizar($procedencia->_id,$procedencia->_procedencia,$procedencia->_plantel,$procedencia->_vive_con,$procedencia->_responsable_retirar,$procedencia->_cedula,$procedencia->_parentesco,$procedencia->_tel_local,$procedencia->_tel_cel,$procedencia->_tel_otro);
		
	}

}

if($modo=='b'){//Listo
$procedencia->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$procedencia->Buscar($procedencia->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Procedencia '.$procedencia->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center >Registro  $procedencia->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$procedencia->Cargar($procedencia->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID := $procedencia->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Responsable:    $procedencia->_responsable_retirar  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Parentesco:  $procedencia->_parentesco  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Vive con:  $procedencia->_vive_con </td></tr></table>";
	}
}

if($modo=='s'){//seleccionar inscripcion
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("procedencias");
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
$ggrupo->set_tabla("procedencias");
$ggrupo->set_Manejador("manejoprocedencia.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridProcedencia.php");

?>


