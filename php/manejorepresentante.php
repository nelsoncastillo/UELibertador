<?php
include_once("representante.php");

$representante= new Representantes;
//print_r ($representante);
//print " /n ";
//var_dump($representante);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or !isset($modo)) $modo='l';
//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
$representante->_cedula = $_REQUEST['txtCedula'];
$representante->_nombre = $_REQUEST['txtNombre'];
$representante->_apellido = $_REQUEST['txtApellido'];
$representante->_fecha_Nacimiento = $_REQUEST['txtFechaNacimiento'];
$representante->_genero = $_REQUEST['lstGenero'];
$representante->_parentesco = $_REQUEST['txtParentesco'];
$representante->_pais = $_REQUEST['txtPais'];
$representante->_estado= $_REQUEST['lstEstado'];
$representante->_estado_civil = $_REQUEST['txtEstadoCivil'];
$representante->_tel_local =  $_REQUEST['txtTelefono'];;
$representante->_tel_cel= $_REQUEST['txtCelular'];
$representante->_oficio= $_REQUEST['txtOficio'];
$representante->_empresa= $_REQUEST['txtEmpresa'];
$representante->_dir_trabajo= $_REQUEST['txtDireccionTrabajo'];
$representante->_tel_trabajo= $_REQUEST['txtTelefonoTrabajo'];
$representante->_correo= $_REQUEST['txtCorreo'];
if (isset($_REQUEST['SsViveConAlumno'])) $representante->_vive_con =$_REQUEST['SsViveConAlumno'];

//print_r ($representante);
$kont =$representante->Buscar($representante->_cedula);
//print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$representante->Agregar($representante->_cedula,$representante->_nombre,$representante->_apellido,$representante->_fecha_Nacimiento,$representante->_pais,$representante->_estado,$representante->_estado_civil,$representante->_genero,$representante->_parentesco,$representante->_tel_local,$representante->_tel_cel,$representante->_oficio,$representante->_empresa,$representante->_dir_trabajo,$representante->_tel_trabajo,$representante->_correo,$representante->_vive_con);
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Representante '.$representante->_cedula.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}
}

if($modo=='e'){//Listo
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$representante->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe muestra msg
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro de Representante '.$_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$representante->Eliminar($_id);
	}
}

if($modo=='m'){
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$representante->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Alumnos.html para agregar registro";
		header("location:Representante.html");
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($representante->get_Representante($_id)==1){
			// aqui deberia  cargar el formulario con datos de este objeto para
			//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_representante_edit" action=manejorepresentante.php?modo=g" method="post" name="frm_representante_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Registro '.$representante->_cedula.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Nombres &nbsp;</td>
<td width="194">&nbsp;<input name="txtNombre" type="text" id="txtNombres" size="27" maxlength="25" value="'.$representante->_nombre.'"></td></tr>
<td width="100">&nbsp;&nbsp; Apellidos &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtApellido" type="text" id="txtApellido" size="27" maxlength="25" value="'.$representante->_apellido.'"></td></tr>
<td width="100">&nbsp;&nbsp; Fecha de Nacimiento &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtFechaNacimiento" type="text" id="txtFechaNacimiento" size="27" maxlength="25" value="'.$representante->_fecha_Nacimiento.'" date="dd-mm-yyyy"></td></tr>
<td width="100">&nbsp;&nbsp; Genero &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="lstGenero" type="text" id="lstGenero" size="27" maxlength="25" value="'.$representante->_genero .'"></td></tr>
<td width="100">&nbsp;&nbsp; Parentesco &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtParentesco" type="text" id="txtParentesco" size="27" maxlength="25" value="'.$representante->_parentesco.'"></td></tr>
<td width="100">&nbsp;&nbsp; Pais &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtPais" type="text" id="txtPais" size="27" maxlength="25" value="'.$representante->_pais.'"></td></tr>
<td width="100">&nbsp;&nbsp; Estado &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtEstado" type="text" id="txtEstado" size="27" maxlength="25" value="'.$representante->_estado.'"></td></tr>
<td width="100">&nbsp;&nbsp; Estado Civil &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtEstadoCivil" type="text" id="txtEstadoCivil" size="27" maxlength="25" value="'.$representante->_estado_civil.'"></td></tr>
<td width="100">&nbsp;&nbsp; Telefono  &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtTelefono" type="text" id="txtTelefono" size="27" maxlength="25" value="'.$representante->_tel_local.'"></td></tr>
<td width="100">&nbsp; Celular &nbsp;</td>
<td width="194">&nbsp;<input name="txtCelular" type="text" id="txtCelular" size="27" maxlength="25" value="'.$representante->_tel_cel.'"></td></tr>
<td width="100">&nbsp; Oficio &nbsp;</td>
<td width="194">&nbsp;<input name="txtOficio" type="text" id="txtOficio" size="27" maxlength="25" value="'.$representante->_oficio.'"></td></tr>
<td width="100">&nbsp;&nbsp; Empresa &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtEmpresa" type="text" id="txtEmpresa" size="27" maxlength="25" value="'.$representante->_empresa.'"></td></tr>
<td width="100">&nbsp;&nbsp; Direccion de Trabajo &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtDireccionTrabajo" type="text" id="txtDireccionTrabajo" size="27" maxlength="25" value="'.$representante->_dir_trabajo.'"></td></tr>
<td width="100">&nbsp;&nbsp; Telefono de Trabajo &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtTelefonoTrabajo" type="text" id="txtTelefonoTrabajo" size="27" maxlength="25" value="'.$representante->_tel_trabajo.'"></td></tr>
<td width="100">&nbsp;&nbsp; Correo &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtCorreo" type="text" id="txtCorreo" size="27" maxlength="25" value="'.$representante->_correo.'"></td></tr>
<td width="100">&nbsp;&nbsp; Vive con el alumno &nbsp;&nbsp;</td>
<td><input name="SsViveConAlumno" class="multiple_choice" id="SsViveConAlumno_0" value="Si" type="radio"><label for="SsViveConAlumno _0">Si</label>
<input name="SsViveConAlumno" class="multiple_choice" id="SsViveConAlumno_1" value="No" type="radio"><label for="SsViveConAlumno _1">No</label></td>
<input name="txtCedula" type="hidden" value="'.$representante->_cedula.'">
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
$representante->_cedula = $_REQUEST['txtCedula'];
$representante->_nombre = $_REQUEST['txtNombre'];
$representante->_apellido = $_REQUEST['txtApellido'];
$representante->_fecha_Nacimiento = $_REQUEST['txtFechaNacimiento'];
$representante->_genero = $_REQUEST['lstGenero'];
$representante->_parentesco = $_REQUEST['txtParentesco'];
$representante->_pais = $_REQUEST['txtPais'];
$representante->_estado= $_REQUEST['txtEstado'];
$representante->_estado_civil = $_REQUEST['txtEstadoCivil'];
$representante->_tel_local =  $_REQUEST['txtTelefono'];;
$representante->_tel_cel= $_REQUEST['txtCelular'];
$representante->_oficio= $_REQUEST['txtOficio'];
$representante->_empresa= $_REQUEST['txtEmpresa'];
$representante->_dir_trabajo= $_REQUEST['txtDireccionTrabajo'];
$representante->_tel_trabajo= $_REQUEST['txtTelefonoTrabajo'];
$representante->_correo= $_REQUEST['txtCorreo'];
if (isset($_REQUEST['SsViveConAlumno'])) $representante->_vive_con =$_REQUEST['SsViveConAlumno'];

//se busca:
$_id = $_REQUEST['txtCedula'];
	$kont =$representante->Buscar($_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$representante->Agregar($representante->_cedula,$representante->_nombre,$representante->_apellido,$representante->_fecha_Nacimiento,$representante->_pais,$representante->_estado,$representante->_estado_civil,$representante->_genero,$representante->_parentesco,$representante->_tel_local,$representante->_tel_cel,$representante->_oficio,$representante->_empresa,$representante->_dir_trabajo,$representante->_tel_trabajo,$representante->_correo,$representante->_vive_con);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$representante->Actualizar($representante->_cedula,$representante->_nombre,$representante->_apellido,$representante->_fecha_Nacimiento,$representante->_pais,$representante->_estado,$representante->_estado_civil,$representante->_genero,$representante->_parentesco,$representante->_tel_local,$representante->_tel_cel,$representante->_oficio,$representante->_empresa,$representante->_dir_trabajo,$representante->_tel_trabajo,$representante->_correo,$representante->_vive_con);
	}

}

if($modo=='b'){
$representante->_cedula= $_REQUEST['txtCedula'];
//se busca:
	$kont =$representante->get_Representante($representante->_cedula);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro Representante '.$representante->_cedula.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center >Registro  $representante->_id  No existe </h3>";
		} else {
		//si existe se muestra
		//$representante->CargarGrupo($representante->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo " Representante CI:= $representante->_cedula ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Nombre:    $representante->_nombre  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Apellido:  $representante->_apellido  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Parentesco:  $representante->_parentesco </td></tr></table>";
	}
}


if($modo=='s'){
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("representantes");
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
$ggrupo->set_tabla("representantes");
$ggrupo->set_Manejador("manejorepresentante.php");
$ggrupo->crear_grilla("representantes",1,'cedula');
*/

header("location:phpgrid/gridRepresentantes.php");

?>


