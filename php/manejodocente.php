<?php
include_once("docentes.php");

$docente= new Docentes;
//print_r ($docente);
//print " /n ";
//var_dump($docente);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or !isset($modo)) $modo='l';
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar llama a Ultimo() en id si existe el id en la db
if($docente->Buscar($_REQUEST['txtId'])>0){
$ultimo=$docente->Ultimo() +1 ;
$docente->_id=$ultimo;
}else{
$docente->_id=$_REQUEST['txtId'];	
	}
$docente->_tipo=$_REQUEST['lstTipo']; 
$docente->_nombre=$_REQUEST['txtNombre']; 
$docente->_cedula=$_REQUEST['txtCedula']; 
$docente->_telefono=$_REQUEST['txtTelefono'];
//print_r ($docente);
$kont =$docente->Buscar($docente->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$docente->Agregar($docente->_id,$docente->_tipo,$docente->_cedula,$docente->_nombre,$docente->_telefono);	
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos de Docente '.$docente->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$docente->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Docente '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$docente->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$docente->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Docentes.html para agregar registro";
		header("location:Docentes.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($docente->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_docente_edit" action=manejodocente.php?modo=g" method="post" name="frm_docente_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Docente '.$_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;ID Docente &nbsp;</td>
<td width="194">&nbsp;<input name="txtId" type="text" id="txtId" size="27" maxlength="25" value="'.$_id.'"></td></tr>
<td width="100">&nbsp;&nbsp;Nombre  &nbsp;</td>
<td width="194">&nbsp;<input name="txtNombre" type="text" id="txtNombre" size="27" maxlength="25" value="'.$docente->_nombre.'"></td></tr>
<td width="100">&nbsp;&nbsp; Tipo de Docente &nbsp;&nbsp;</td>
<td width="194"><div tipo>
<select id="lstTipo" name="lstTipo" class="drop_down">
<option selected="selected"></option>
<option value="Doc">DOCENTE</option>
<option value="Aux">Auxiliar</option>
</select></div></td></tr>
<td width="100">&nbsp;&nbsp;Cedula &nbsp;</td>
<td width="194">&nbsp;<input name="txtCedula" type="text" id="txtCedula" size="27" maxlength="25" value="'.$docente->_cedula.'"></td></tr>
<td width="100">&nbsp;&nbsp;Telefono &nbsp;</td>
<td width="194">&nbsp;<input name="txtTelefono" type="text" id="txtTelefono" size="27" maxlength="25" value="'.$docente->_telefono.'"></td></tr>
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
$docente->_id= $_REQUEST['txtId'];
$docente->_tipo=$_REQUEST['lstTipo']; 
$docente->_nombre=$_REQUEST['txtNombre']; 
$docente->_cedula=$_REQUEST['txtCedula']; 
$docente->_telefono=$_REQUEST['txtTelefono'];
//echo var_dump($docente);
//se busca:
$_id = $_REQUEST['txtId'];
/*
echo " esta es id ".$_id;
echo " esto es docenteid ".$docente->_id;
*/

	$kont =$docente->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$docente->Agregar($docente->_id,$docente->_tipo,$docente->_cedula,$docente->_nombre,$docente->_telefono);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$docente->Actualizar($docente->_id,$docente->_tipo,$docente->_cedula,$docente->_nombre,$docente->_telefono);	
		
	}

}

if($modo=='b'){//Listo
$docente->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$docente->Buscar($docente->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Habitacion '.$docente->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center > Registro $docente->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$docente->Cargar($docente->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID :=$docente->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Nombre:   $docente->_nombre  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Tipo: $docente->_tipo  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Cedula: $docente->_cedula </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Telefono: $docente->_telefono</td></tr></table>";
	}
}

/*
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("docentes");
$ggrupo->set_Manejador("manejodocente.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridDocentes.php");


?>


