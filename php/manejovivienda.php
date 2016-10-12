<?php
include_once("vivienda.php");

$vivienda= new Vivienda;
//print_r ($vivienda);
//print " /n ";
//var_dump($vivienda);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or !isset($modo)) $modo='l';
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar uno nuevo llama a Ultimo() en id
 $ultimo=$vivienda->Ultimo() +1;
 $vivienda->_id= $_REQUEST['txtId'];
 $vivienda->_tipo=$_REQUEST['lstTipovivienda']; 
 $vivienda->_ubicacion=$_REQUEST['lstUbicacion']; 
 $vivienda->_nombre_ubicacion=$_REQUEST['txtNombreUbicacion']; 
 $vivienda->_condiciones=$_REQUEST['lstCondicionesvida']; 
 $vivienda->_via=$_REQUEST['lstTipovia']; 
 $vivienda->_nombre_via=$_REQUEST['txtNombreVia'];
 $vivienda->_direccion=$_REQUEST['txtDireccion'];
 $vivienda->_telefono=$_REQUEST['txtTelefono'];
 
//print_r ($vivienda);
$kont =$vivienda->Buscar($vivienda->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$vivienda->Agregar($vivienda->_id,$vivienda->_tipo,$vivienda->_ubicacion,$vivienda->_nombre_ubicacion,$vivienda->_condiciones,$vivienda->_via,$vivienda->_nombre_via,$vivienda->_direccion,$vivienda->_telefono);	
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos de Habitacion '.$vivienda->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$vivienda->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Vivienda '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$vivienda->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$vivienda->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Procedencia.html para agregar registro";
		header("location:Procedencia.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($vivienda->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_vivienda_edit" action=manejovivienda.php?modo=g" method="post" name="frm_vivienda_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Habitacion '.$_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Tipo de Vivivenda &nbsp;</td>
<td width="194">&nbsp;<input name="lstTipovivienda" type="text" id="lstTipovivienda" size="27" maxlength="25" value="'.$vivienda->_tipo.'"></td></tr>
<td width="100">&nbsp;&nbsp;Ubicacion &nbsp;</td>
<td width="194">&nbsp;<input name="lstUbicacion" type="text" id="lstUbicacion" size="27" maxlength="25" value="'.$vivienda->_ubicacion.'"></td></tr>
<td width="100">&nbsp;&nbsp;Nombre de Ubicacion &nbsp;</td>
<td width="194">&nbsp;<input name="txtNombreUbicacion" type="text" id="txtNombreUbicacion" size="27" maxlength="25" value="'.$vivienda->_nombre_ubicacion.'"></td></tr>
<td width="100">&nbsp;&nbsp;Condiciones &nbsp;</td>
<td width="194">&nbsp;<input name="lstCondicionesvida" type="text" id="lstCondicionesvida" size="27" maxlength="25" value="'.$vivienda->_condiciones.'"></td></tr>
<td width="100">&nbsp;&nbsp; Tipo de via &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="lstTipovia" type="text" id="lstTipovia" size="27" maxlength="25" value="'.$vivienda->_via.'"></td></tr>
<td width="100">&nbsp;&nbsp;Nombre Via&nbsp;</td>
<td width="194">&nbsp;<input name="txtNombreVia" type="text" id="txtNombreVia" size="27" maxlength="25" value="'.$vivienda->_nombre_via.'"></td></tr>
<td width="100">&nbsp;&nbsp;Direccion&nbsp;</td>
<td width="194">&nbsp;<input name="txtDireccion" type="text" id="txtDireccion" size="27" maxlength="25" value="'.$vivienda->_direccion.'"></td></tr>
<td width="100">&nbsp;&nbsp;Telefono &nbsp;</td>
<td width="194">&nbsp;<input name="txtTelefono" type="text" id="txtTelefono" size="27" maxlength="25" value="'.$vivienda->_telefono.'"></td></tr>
<input name="txtId" type="hidden" value="'.$_id.'">
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
 $vivienda->_id= $_REQUEST['txtId'];
 $vivienda->_tipo=$_REQUEST['lstTipovivienda']; 
 $vivienda->_ubicacion=$_REQUEST['lstUbicacion']; 
 $vivienda->_nombre_ubicacion=$_REQUEST['txtNombreUbicacion']; 
 $vivienda->_condiciones=$_REQUEST['lstCondicionesvida']; 
 $vivienda->_via=$_REQUEST['lstTipovia']; 
 $vivienda->_nombre_via=$_REQUEST['txtNombreVia'];
 $vivienda->_direccion=$_REQUEST['txtDireccion'];
 $vivienda->_telefono=$_REQUEST['txtTelefono'];
//se busca:
$_id = $_REQUEST['txtId'];
	$kont =$vivienda->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$vivienda->Agregar($vivienda->_id,$vivienda->_tipo,$vivienda->_ubicacion,$vivienda->_nombre_ubicacion,$vivienda->_condiciones,$vivienda->_via,$vivienda->_nombre_via,$vivienda->_direccion,$vivienda->_telefono);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$vivienda->Actualizar($vivienda->_id,$vivienda->_tipo,$vivienda->_ubicacion,$vivienda->_nombre_ubicacion,$vivienda->_condiciones,$vivienda->_via,$vivienda->_nombre_via,$vivienda->_direccion,$vivienda->_telefono);	
		
	}

}

if($modo=='b'){//Listo
$vivienda->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$vivienda->Buscar($vivienda->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Habitacion '.$vivienda->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center > Registro  $vivienda->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$vivienda->Cargar($vivienda->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID := $vivienda->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Tipo:    $vivienda->_tipo  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Ubicacion:  $vivienda->_ubicacion  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Nombre:  $vivienda->_nombre_ubicacion </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Nombre Via:  $vivienda->_nombre_via</td></tr>";		
		echo '<td colspan="2"><div align="center">';
		echo " Direccion:  $vivienda->_direccion </td></tr></table>";
	}
}

if($modo=='s'){//seleccionar inscripcion
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("viviendas");
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
$ggrupo->set_tabla("viviendas");
$ggrupo->set_Manejador("manejovivienda.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridVivienda.php");

?>


