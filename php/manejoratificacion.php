<?php
include_once("ratificacion.php");

function Ratificar($idRatif,$idInsc){//falta
	$ratif=new Ratificacion;
	if($ratificacion->Buscar($idRatif)>0){
		//encuentra la idRatificacion
		$ratif->Cargar($idRatif);
		include_once("inscripcion.php");
		$ins= new Inscripcion;
		if($ins->Buscar($idInsc)>0){
			$insc->Cargar($idInsc);
			//aqui debe devolver las $idRatif e $idInsc
			$par = array( "Ratif" => $ratif->_id, "Insc" => $insc->_id,);
			return $par;
			}else{
			echo " Debe seleccionar una Inscripcion valida ";	
			return -1;
			}
		}else{ 
			//si no esta debe registrarse
		echo " Debe cargar la ratificacion Id: $idRatif	";
		return -1;
		}
}

$ratificacion= new Ratificacion;
//print_r ($ratificacion);
//print " /n ";
//var_dump($ratificacion);
//-- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
//para agregar llama a Ultimo() en id si existe el id en la db
if($ratificacion->Buscar($_REQUEST['txtId'])>0){
$ultimo=$ratificacion->Ultimo() +1 ;
$ratificacion->_id=$ultimo;
}else{
$ratificacion->_id=$_REQUEST['txtId'];	
	}
$ratificacion->_fecha_ratificacion=$_REQUEST['txtFechaInscrocipcion']; 
$ratificacion->_id_inscripcion=$_REQUEST['txtIdInscripcion']; 
$ratificacion->_docente_ratifica=$_REQUEST['txtDocenteInscribe']; 
$ratificacion->_observaciones=$_REQUEST['txtObservaciones'];

//print_r ($ratificacion);
$kont =$ratificacion->Buscar($ratificacion->_id);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega	
		//if (Ratificar($ratificacion->_id, $ratificacion->_id_inscripcion)!= -1){
		$ratificacion->Agregar($ratificacion->_id,$ratificacion->_fecha_ratificacion,$ratificacion->_id_inscripcion,$ratificacion->_docente_ratifica,$ratificacion->_observaciones);
		//}else{
		//echo "Verificar que existen la Id de Ratificacion y "	
		//	}
	} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Ratificacion '.$ratificacion->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$ratificacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Ratificacion '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$ratificacion->Eliminar($_id);
	}
}

if($modo=='m'){ //falta
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$ratificacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Rartificacion.html para agregar registro";
		header("location:Ratificacion.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($ratificacion->Cargar($_id)==1){
// aqui deberia  cargar el formulario con datos de este objeto para
//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_ratifica_edit" action=manejoratificacion.php?modo=g" method="post" name="frm_ratifica_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Docente '.$_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;ID Ratificacion &nbsp;</td>
<td width="194">&nbsp;<input name="txtId" type="text" id="txtId" size="27" maxlength="25" value="'.$_id.'"></td></tr>
<td width="100">&nbsp;&nbsp;Fecha de Ratificacion &nbsp;</td>
<td width="194">&nbsp;<input name="txtFechaInscrocipcion" type="text" id="txtFechaInscrocipcion" size="27" maxlength="25" value="'.$ratificacion->_fecha_ratificacion.'"></td></tr>
<td width="100">&nbsp;&nbsp;Id Isncripcion &nbsp;</td>
<td width="194">&nbsp;<input name="txtIdInscripcion" type="text" id="txtIdInscripcion" size="27" maxlength="25" value="'.$ratificacion->_id_inscripcion.'"></td></tr>
<td width="100">&nbsp;&nbsp;Docente que Ratifica &nbsp;</td>
<td width="194">&nbsp;<input name="txtDocenteInscribe" type="text" id="txtDocenteInscribe" size="27" maxlength="25" value="'.$ratificacion->_docente_ratifica.'"></td></tr>
<td width="100">&nbsp;&nbsp; Observaciones  &nbsp;</td>
<td width="194">&nbsp;<input name="txtObservaciones" type="text" id="txtObservaciones" size="27" maxlength="25" value="'.$ratificacion->_observaciones.'"></td></tr>
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
//viene del formulario de modificacion
$ratificacion->_id=$_REQUEST['txtId'];	
$ratificacion->_fecha_ratificacion=$_REQUEST['txtFechaInscrocipcion']; 
$ratificacion->_id_inscripcion=$_REQUEST['txtIdInscripcion']; 
$ratificacion->_docente_ratifica=$_REQUEST['txtDocenteInscribe']; 
$ratificacion->_observaciones=$_REQUEST['txtObservaciones'];
//se busca:
$_id = $_REQUEST['txtId'];
/*
echo " esta es id ".$_id;
echo " esto es docenteid ".$ratificacion->_id;
*/

	$kont =$ratificacion->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$ratificacion->Agregar($ratificacion->_id,$ratificacion->_tipo,$ratificacion->_cedula,$ratificacion->_nombre,$ratificacion->_telefono);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$ratificacion->Actualizar($ratificacion->_id,$ratificacion->_tipo,$ratificacion->_cedula,$ratificacion->_nombre,$ratificacion->_telefono);	
		
	}

}

if($modo=='b'){//Listo
$ratificacion->_id= $_REQUEST['txtId'];
//se busca:
	$kont =$ratificacion->Buscar($ratificacion->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Datos Habitacion '.$ratificacion->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center > Registro $ratificacion->_id  No existe </h3>";
		} else {
		//si existe se muestra
		$ratificacion->Cargar($ratificacion->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " ID :=$ratificacion->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Fecha de Ratificacion:   $ratificacion->_fecha_ratificacion  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Id de Inscripcion: $ratificacion->_id_inscripcion  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Docente que Ratifica: $ratificacion->_docente_ratifica </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Observaciones: $ratificacion->_observaciones</td></tr></table>";

	}
}

if($modo=='s'){//seleccionar inscripcion
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new Grilla;
	$ginscr->set_tabla("inscripciones");
	if(isset($_REQUEST['fuera'])){ 
		if($_REQUEST['fuera']=='s'){
			$ginscr->set_Manejador("php/manejoratificacion.php");
			}else{
				$ginscr->set_Manejador("manejoratificacion.php");
				}
		}else{
			$ginscr->set_Manejador("manejoratificacion.php");
			}
	$ginscr->crear_grilla($ginscr->tabla,1,'i');
	
	}

if($modo=='si'){//seleccionar inscripcion
	//devolver el id de la inscripcion seleccionada
			$resultado= $_REQUEST['id']; 
			echo $resultado;
	}

/*
if($modo!='s' and $modo!='si'){
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("ratificaciones");
$ggrupo->set_Manejador("manejoratificacion.php");
$ggrupo->crear_grilla($ggrupo->tabla,1,'i');
}
*/

header("location:phpgrid/gridRatificaciones.php");

?>


