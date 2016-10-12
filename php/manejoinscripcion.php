<?php
include_once("inscripcion.php");

$inscripcion= new Inscripcion;
$modo=$_REQUEST['modo'];
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar llama a Ultimo() en id si existe el id en la db
if($inscripcion->Buscar($_REQUEST['txtId'])>0){
$ultimo=$inscripcion->Ultimo() +1 ;
$inscripcion->_id=$ultimo;
}else{
$inscripcion->_id=$_REQUEST['txtId'];	
	}
$inscripcion->_fecha_inscripcion_inicial=$_REQUEST['txtFechaInscripcion']; 
$inscripcion->_anno_escolar=$_REQUEST['txtAnnoEscolar']; 
$inscripcion->_docente=$_REQUEST['txtDocente']; 

//print_r ($inscripcion);
$kont =$inscripcion->Buscar($inscripcion->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$inscripcion->Agregar($inscripcion->_id,$inscripcion->_fecha_inscripcion_inicial,$inscripcion->_anno_escolar,$inscripcion->_docente);	
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos de Docente '.$inscripcion->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$inscripcion->Buscar($_id);
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
		$inscripcion->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$inscripcion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Inscripsion.html para agregar registro";
		header("location:Inscripcion.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($inscripcion->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_inscripcion_edit" action=manejoinscripcion.php?modo=g" method="post" name="frm_inscripcion_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Inscripcion '.$_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;ID Inscripcion &nbsp;</td>
<td width="194">&nbsp;<input name="txtId" type="text" id="txtId" size="27" maxlength="25" value="'.$_id.'"></td></tr>
<td width="100">&nbsp;&nbsp;Fecha de Inscripcion  &nbsp;</td>
<td width="194">&nbsp;<input name="txtFechaInscripcion" type="text" id="txtFechaInscripcion" size="27" maxlength="25" value="'.$inscripcion->_fecha_inscripcion_inicial.'"></td></tr>
<td width="100">&nbsp;&nbsp;Año escolar &nbsp;</td>
<td width="194">&nbsp;<input name="txtAnnoEscolar" type="text" id="txtAnnoEscolar" size="27" maxlength="25" value="'.$inscripcion->_anno_escolar.'"></td></tr>
<td width="100">&nbsp;&nbsp;Docente &nbsp;</td>
<td width="194">&nbsp;<input name="txtDocente" type="text" id="txtDocente" size="27" maxlength="25" value="'.$inscripcion->_docente.'"></td></tr>
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
$inscripcion->_id=$_REQUEST['txtId'];
$inscripcion->_fecha_inscripcion_inicial=$_REQUEST['txtFechaInscripcion']; 
$inscripcion->_anno_escolar=$_REQUEST['txtAnnoEscolar']; 
$inscripcion->_docente=$_REQUEST['txtDocente']; 
//echo var_dump($inscripcion);
//se busca:
$_id = $_REQUEST['txtId'];
/*
echo " esta es id ".$_id;
echo " esto es docenteid ".$inscripcion->_id;
*/

	$kont =$inscripcion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$inscripcion->Agregar($inscripcion->_id,$inscripcion->_fecha_inscripcion_inicial,$inscripcion->_anno_escolar,$inscripcion->_docente);	
		} else {
		//si existe mensage de ya existe
		//actualizar
		$inscripcion->Actualizar($inscripcion->_id,$inscripcion->_fecha_inscripcion_inicial,$inscripcion->_anno_escolar,$inscripcion->_docente);		
	}

}

if($modo=='b'){//Listo
$inscripcion->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$inscripcion->Buscar($inscripcion->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Habitacion '.$inscripcion->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center > Registro $inscripcion->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$inscripcion->Cargar($inscripcion->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID :=$inscripcion->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Fecha de Inscripcion:   $inscripcion->_fecha_inscripcion_inicial  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Año Escolar: $inscripcion->_anno_escolar  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Docente inscriptor: $inscripcion->_docente</td></tr></table>";
	}
}

/*
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("inscripciones");
$ggrupo->set_Manejador("manejoinscripcion.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
*/

header("location:phpgrid/gridInscripciones.php");

?>


