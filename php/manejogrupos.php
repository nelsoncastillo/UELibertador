<?php
include_once("grupo.php");
$grupo= new Grupo;
//print_r ($grupo);
//print " /n ";
//var_dump($grupo);

//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or isset($modo)) $modo='l';

//primero buscar por id
if($modo=='a'){
//viene del formulario Grupos.html
$grupo->_id = $_REQUEST['txtId'];
$grupo->_grupo = $_REQUEST['txtGrupo'];
$grupo->_seccion = $_REQUEST['txtSeccion'];
$grupo->_periodo = $_REQUEST['txtPeriodo'];
$grupo->_turno = $_REQUEST['lstTurno'];

	$kont =$grupo->Leer($grupo->_id);
	//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$grupo->Agregar($grupo->_id, $grupo->_grupo,$grupo->_seccion,$grupo->_periodo, $grupo->_turno );
		} else {
		//si existe mensage de ya existe
		echo "<h3 text-align: center >Registro  $grupo->_id  ya existe </h3>";
	}

}

if($modo=='e'){
// ---- Viene del Grid
$grupo->_id = $_REQUEST['id'];
//se busca:
	$kont =$grupo->Leer($grupo->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		echo "<h3 text-align: center >Registro  $grupo->_id  No existe </h3>";
		} else {
		//si existe se elimina
		$grupo->Eliminar($grupo->_id);
	}
}

if($modo=='m'){
// ---- Viene del Grid
$grupo->_id = $_REQUEST['id'];
//se busca:
	$kont =$grupo->Leer($grupo->_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Grupos.html para agregar registro";
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($grupo->CargarGrupo($grupo->_id)==1){
			// aqui deberia  cargar el formulario con datos de este objeto para
			//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
			$strout1='<form id="frm_grupos_edit" action=manejogrupos.php?modo=g" method="post" name="frm_grupos_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Grupo '.$grupo->_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Grupo &nbsp;</td>
      <td width="194">&nbsp;
      <input name="grupo" type="text" id="grupo" size="27" maxlength="25" value="'.$grupo->_grupo.'"></td></tr>
<td width="100">&nbsp;&nbsp; Seccion &nbsp;&nbsp;</td>
      <td width="194">&nbsp;
      <input name="seccion" type="text" id="seccion" size="27" maxlength="25" value="'.$grupo->_seccion.'"></td></tr>
<td width="100">&nbsp;&nbsp; Periodo &nbsp;&nbsp;</td>
	   <td width="194">&nbsp;
      <input name="periodo" type="text" id="periodo" size="27" maxlength="30" value="'.$grupo->_periodo.'"></td></tr>
<td width="100">&nbsp;&nbsp; Turno &nbsp;&nbsp;</td>
	   <td width="194">&nbsp;
      <input name="turno" type="text" id="turno" size="27" maxlength="25" value="'.$grupo->_turno.'"></td></tr>
      <input name="id" type="hidden" value="'.$grupo->_id.'">
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

if($modo=='g'){
//viene del formulario Grupos.html
$grupo->_id = $_REQUEST['id'];
$grupo->_grupo = $_REQUEST['grupo'];
$grupo->_seccion = $_REQUEST['seccion'];
$grupo->_periodo = $_REQUEST['periodo'];
$grupo->_turno = $_REQUEST['turno'];

	$kont =$grupo->Leer($grupo->_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		//$grupo->Agregar($grupo->_id, $grupo->_grupo,$grupo->_seccion,$grupo->_periodo, $grupo->_turno );
		} else {
		//si existe mensage de ya existe
		//actualizar
		$grupo->Actualizar($grupo->_id, $grupo->_grupo,$grupo->_seccion,$grupo->_periodo, $grupo->_turno );
	}

}

if($modo=='b'){
$grupo->_id = $_REQUEST['id'];
//se busca:
	$kont =$grupo->Leer($grupo->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro '.$docente->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se muestra
		$grupo->CargarGrupo($grupo->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " Registro para Grupo Id:  $grupo->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Grupo:    $grupo->_grupo  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Seccion:  $grupo->_seccion  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo "  Periodo:  $grupo->_periodo </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Turno:    $grupo->_turno  </td></tr></table>";

	}
}

/*
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("grupos");
$ggrupo->set_Manejador("manejogrupos.php");
$ggrupo->crear_grilla("grupos",1,'i');
*/

header("location:phpgrid/gridGrupos.php");

?>


