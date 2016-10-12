<?php
include_once("alumno.php");
$alumno= new Alumno;
//print_r ($alumno);
//print " /n ";
//var_dump($alumno);
//-------------- obtener modo de ejecucion e-eliminar, m-editar a-agregar
$modo=$_REQUEST['modo'];
//if (empty($modo) or isset($modo)) $modo='l';

//primero buscar por id y agregar
if($modo=='a'){//Listo
//viene del formulario Alumnos.html
$alumno->_id = $_REQUEST['txtId'];
$alumno->_nombre = $_REQUEST['txtNombres'];
$alumno->_apellido = $_REQUEST['txtApellido'];
$alumno->_fecha_Nacimiento = $_REQUEST['txtFechaNacimiento'];
$alumno->_sexo = $_REQUEST['lstSexo'];
$alumno->_ci_escolar = $_REQUEST['txtCiEscolar'];
$alumno->_pais = $_REQUEST['lstPais'];
$alumno->_estado= $_REQUEST['lstEstado'];
$alumno->_ciudad = $_REQUEST['txtCiudad'];
$alumno->_orden_nacimiento = $_REQUEST['txtOrdenNacimiento'];
$alumno->_tipo_parto = $_REQUEST['txtTipoParto'];
if ($_REQUEST['ssParto']=="Simple") $alumno->_multiple_parto ='N';
if ($_REQUEST['ssParto']=="Multiple") $alumno->_multiple_parto ='S';

$alumno->_numero_parto = $_REQUEST['txtNumeroNacimiento'];

	$alumno->_tratamiento_medico = "No";
	$alumno->_tratamiento_odontologico = "No";
	$alumno->_tratamiento_psicologico = "No";

if (isset($_REQUEST['msTratamientos_0'])) {
	$alumno->_tratamiento_medico = "Si";	
	}

if (isset($_REQUEST['msTratamientos_1'])) {
	$alumno->_tratamiento_odontologico = "Si";	
	}
if (isset($_REQUEST['msTratamientos_2'])) {
	$alumno->_tratamiento_psicologico = "Si";	
	}
if (isset($_REQUEST['msTratamientos_3'])) {
	$alumno->_tratamiento_medico = "No";
	$alumno->_tratamiento_odontologico = "No";
	$alumno->_tratamiento_psicologico = "No";
	}
	
	$alumno->_problemas_lenguaje="No";
	$alumno->_problemas_vision = "No";
	$alumno->_problemas_parto = "No";
	
if (isset($_REQUEST['msProblemas_0'])){ 
		$alumno->_problemas_lenguaje= "Si";
		}
if (isset($_REQUEST['msProblemas_1'])){ 
		$alumno->_problemas_vision= "Si";
		}
if (isset($_REQUEST['msProblemas_2'])){ 
		$alumno->_problemas_parto= "Si";
		}	
if (isset($_REQUEST['msProblemas_3'])){ 
	$alumno->_problemas_lenguaje="No";
	$alumno->_problemas_vision = "No";
	$alumno->_problemas_parto = "No";
		}
$alumno->_enfermedades = $_REQUEST['txtEnfermedades'];
$alumno->_control_vacunas = $_REQUEST['txtControlVacunas'];
$alumno->_alergias = $_REQUEST['txtAlergias'];
$alumno->_talla = $_REQUEST['txtTalla'];
$alumno->_peso = $_REQUEST['txtPeso'];
$alumno->_responsable_primeros = $_REQUEST['txtResponsable'];
$alumno->_beca = $_REQUEST['ssBeca'];
$alumno->_canaima = $_REQUEST['ssCanaima'];

//print_r ($alumno);
	$kont =$alumno->Leer($alumno->_id);
	print "Contador:".$kont." \n "; 
	if ($kont==-1 ) {
		//si no existe se agrega
		$alumno->Agregar($alumno->_id,$alumno->_nombre,$alumno->_apellido,$alumno->_sexo,$alumno->_ci_escolar,$alumno->_fecha_Nacimiento,$alumno->_pais,$alumno->_estado,$alumno->_ciudad,$alumno->_orden_nacimiento,$alumno->_tipo_parto,$alumno->_numero_parto,$alumno->_multiple_parto,$alumno->_problemas_lenguaje,$alumno->_problemas_vision,$alumno->_problemas_parto,$alumno->_tratamiento_medico,$alumno->_tratamiento_odontologico,$alumno->_tratamiento_psicologico,$alumno->_enfermedades,$alumno->_control_vacunas,$alumno->_alergias,$alumno->_talla,$alumno->_peso,$alumno->_responsable_primeros,$alumno->_beca,$alumno->_canaima);
		} else {
		//si existe mensaje de ya existe
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro  '.$alumno->_id.'  ya existe</div></td>
		</tr>
		</table>';
		echo $msg;
	}

}

if($modo=='e'){//Listo
// ---- Viene del Grid
$alumno->_id = $_REQUEST['id'];
//se busca:
	$kont =$alumno->Leer($alumno->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro  '.$alumno->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		} else {
		//si existe se elimina
		$alumno->Eliminar($alumno->_id);
	}
}

if($modo=='m'){
// ---- Viene del Grid
$_id = $_REQUEST['id'];
//se busca:
	$kont =$alumno->Leer($_id);
	if ($kont==-1 ) {
		//si no existe deberia agregarlo
		echo "Mensaje notificando que no existe y carga el formulario Alumnos.html para agregar registro";
		
	} else {
		//si existe se modifica
		if($kont>=1) {
			if($alumno->get_Alumno($_id)==1){
			// aqui deberia  cargar el formulario con datos de este objeto para
			//modificar a gusto, y al guardar reemplaza el objeto, la id no debe cambiar
$strout1='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><form id="frm_alumnos_edit" action=manejoalumnos.php?modo=g" method="post" name="frm_alumnos_edit" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Editar Alumno '.$alumno->_id.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Nombres &nbsp;</td>
<td width="194">&nbsp;<input name="txtNombre" type="text" id="txtNombres" size="27" maxlength="25" value="'.$alumno->_nombre.'"></td></tr>
<td width="100">&nbsp;&nbsp; Apellidos &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtApellido" type="text" id="txtApellido" size="27" maxlength="25" value="'.$alumno->_apellido.'"></td></tr>
<td width="100">&nbsp;&nbsp; Fecha de Nacimiento &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtFechaNacimiento" type="text" id="txtFechaNacimiento" size="27" maxlength="25" value="'.$alumno->_fecha_Nacimiento.'"></td></tr>
<td width="100">&nbsp;&nbsp; Sexo &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtSexo" type="text" id="txtSexo" size="27" maxlength="25" value="'.$alumno->_sexo .'"></td></tr>
<td width="100">&nbsp;&nbsp; Cedula Escolar &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtCiEscolar" type="text" id="txtCiEscolar" size="27" maxlength="25" value="'.$alumno->_ci_escolar.'"></td></tr>
<td width="100">&nbsp;&nbsp; Pais &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtPais" type="text" id="txtPais" size="27" maxlength="25" value="'.$alumno->_pais.'"></td></tr>
<td width="100">&nbsp;&nbsp; Estado &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtEstado" type="text" id="txtEstado" size="27" maxlength="25" value="'.$alumno->_estado.'"></td></tr>
<td width="100">&nbsp;&nbsp; Ciudad &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtCiudad" type="text" id="txtCiudad" size="27" maxlength="25" value="'.$alumno->_ciudad.'"></td></tr>
<td width="100">&nbsp;&nbsp; Orden de Nacimiento &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtOrdenNacimiento" type="text" id="txtOrdenNacimiento" size="27" maxlength="25" value="'.$alumno->_orden_nacimiento.'"></td></tr>
<td width="100">&nbsp; Tipo de Parto &nbsp;</td>
<td width="194">&nbsp;<input name="txtTipoParto" type="text" id="txtTipoParto" size="27" maxlength="25" value="'.$alumno->_tipo_parto.'"></td></tr>
<td width="100"><div multiple>&nbsp; Parto Multiple &nbsp;</td>
<td><input type="checkbox" name="chPartoSimple" value="Simple" checked> Parto Simple<br>
<input type="checkbox" name="chPartoMultiple" value="Multiple"> Parto Multiple<br></div></td></tr>
<td width="100">&nbsp; Numero de Nacimiento &nbsp;</td>
<td width="194">&nbsp;<input name="txtNumeroParto" type="text" id="txtNumeroParto" size="27" maxlength="25" value="'.$alumno->_numero_parto.'"></td></tr>
<td width="100">&nbsp;<div tratamientos> Tratamientos &nbsp;</td>
<td><input type="checkbox" name="chTratamientoMedico" value="Si"> Tratamiento Medico <br>
<input type="checkbox" name="chTratamientoPsicologico" value="Si"> Tratamiento Psicologico<br>
<input type="checkbox" name="chTratamientoOdontologico" value="Si"> Tratamiento Odontologico<br></td></div></tr>
<td width="100"><div problemas>&nbsp; Problemas &nbsp;</td>
<td><input type="checkbox" name="chProblemasLenguaje" value="Lenguaje"> Problemas Lenguajes <br>
<input type="checkbox" name="chProblemasVision" value="Visual"> Problemas Visuales<br>
<input type="checkbox" name="chProblemasParto" value="Parto"> Problemas de Parto<br></td>
</div></tr>
<td width="100">&nbsp;&nbsp; Enfermedades &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtEnfermedades" type="text" id="txtEnfermedades" size="27" maxlength="25" value="'.$alumno->_enfermedades.'"></td></tr>
<td width="100">&nbsp;&nbsp; Control de Vacunas &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtControlVacunas" type="text" id="txtControlVacunas" size="27" maxlength="25" value="'.$alumno->_control_vacunas.'"></td></tr>
<td width="100">&nbsp;&nbsp; Alergias &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtAlergias" type="text" id="txtAlergias" size="27" maxlength="25" value="'.$alumno->_alergias.'"></td></tr>
<td width="100">&nbsp;&nbsp; Talla &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtTalla" type="text" id="txtTalla" size="27" maxlength="25" value="'.$alumno->_talla.'"></td></tr>
<td width="100">&nbsp;&nbsp; Peso &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtPeso" type="text" id="txtPeso" size="27" maxlength="25" value="'.$alumno->_peso.'"></td></tr>
<td width="100">&nbsp;&nbsp; Responsable de primeros años &nbsp;&nbsp;</td>
<td width="194">&nbsp;<input name="txtResponsable" type="text" id="txtResponsable" size="27" maxlength="25" value="'.$alumno->_responsable_primeros.'"></td></tr>
<td width="100"><div beneficios>&nbsp; Beneficios &nbsp;</td>
<td><input type="checkbox" name="ssBeca" value="Si"> Beca <br>
<input type="checkbox" name="ssCanaima" value="Si"> Canaima<br></div></td>
<input name="txtid" type="hidden" value="'.$alumno->_id.'">
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
$alumno->_id = $_REQUEST['txtid'];
$alumno->_nombre = $_REQUEST['txtNombre'];
$alumno->_apellido = $_REQUEST['txtApellido'];
$alumno->_fecha_Nacimiento = $_REQUEST['txtFechaNacimiento'];
$alumno->_sexo = $_REQUEST['txtSexo'];
$alumno->_ci_escolar = $_REQUEST['txtCiEscolar'];
$alumno->_pais = $_REQUEST['txtPais'];
$alumno->_estado= $_REQUEST['txtEstado'];
$alumno->_ciudad = $_REQUEST['txtCiudad'];
$alumno->_orden_nacimiento = $_REQUEST['txtOrdenNacimiento'];
$alumno->_tipo_parto = $_REQUEST['txtTipoParto'];
if (isset($_REQUEST['chPartoSimple']) and $_REQUEST['chPartoSimple']=="Simple") $alumno->_multiple_parto ='N';
if (isset($_REQUEST['chPartoMultiple']) and $_REQUEST['chPartoMultiple']=="Multiple") $alumno->_multiple_parto ='S';
$alumno->_numero_parto = $_REQUEST['txtNumeroParto'];
if (isset($_REQUEST['chTratamientoMedico'])) {
	$alumno->_tratamiento_medico = "Si";	
	}else{
	$alumno->_tratamiento_medico = "No";	
		}
if (isset($_REQUEST['chTratamientoPsicologico'])) {
	$alumno->_tratamiento_psicologico = "Si";	
	}else{
	$alumno->_tratamiento_psicologico = "No";	
		}
if (isset($_REQUEST['chTratamientoOdontologico'])) {
	$alumno->_tratamiento_odontologico = "Si";	
	}else{
	$alumno->_tratamiento_odontologico = "No";		
		}
		
if (isset($_REQUEST['chProblemasLenguaje'])){ 
		$alumno->_problemas_lenguaje= "Si";
		}else{
		$alumno->_problemas_lenguaje= "No";	
			}
if (isset($_REQUEST['chProblemasVision'])){ 
		$alumno->_problemas_vision= "Si";
		}else{
		$alumno->_problemas_vision= "No";	
			}
if (isset($_REQUEST['chProblemasParto'])){ 
		$alumno->_problemas_parto= "Si";
		}else{
		$alumno->_problemas_parto= "No";	
			}	
$alumno->_enfermedades = $_REQUEST['txtEnfermedades'];
$alumno->_control_vacunas = $_REQUEST['txtControlVacunas'];
$alumno->_alergias = $_REQUEST['txtAlergias'];
$alumno->_talla = $_REQUEST['txtTalla'];
$alumno->_peso = $_REQUEST['txtPeso'];
$alumno->_responsable_primeros = $_REQUEST['txtResponsable'];

if (isset($_REQUEST['ssBeca'])){ 
		$alumno->_beca= "Si";
		}else{
		$alumno->_beca= "No";	
			}	
if (isset($_REQUEST['ssCanaima'])){ 
		$alumno->_canaima= "Si";
		}else{
		$alumno->_canaima= "No";	
			}	

	$kont=$alumno->Leer($alumno->_id);
	if ($kont==-1 ) {
		//si no existe se agrega
		$alumno->Agregar($alumno->_id,$alumno->_nombre,$alumno->_apellido,$alumno->_sexo,$alumno->_ci_escolar,$alumno->_fecha_Nacimiento,$alumno->_pais,$alumno->_estado,$alumno->_ciudad,$alumno->_orden_nacimiento,$alumno->_tipo_parto,$alumno->_numero_parto,$alumno->_multiple_parto,$alumno->_problemas_lenguaje,$alumno->_problemas_vision,$alumno->_problemas_parto,$alumno->_tratamiento_medico,$alumno->_tratamiento_odontologico,$alumno->_tratamiento_psicologico,$alumno->_enfermedades,$alumno->_control_vacunas,$alumno->_alergias,$alumno->_talla,$alumno->_peso,$alumno->_responsable_primeros,$alumno->_beca,$alumno->_canaima);
		} else {
		//si existe mensage de ya existe
		//actualizar
		$alumno->Actualizar($alumno->_id,$alumno->_nombre,$alumno->_apellido,$alumno->_sexo,$alumno->_ci_escolar,$alumno->_fecha_Nacimiento,$alumno->_pais,$alumno->_estado,$alumno->_ciudad,$alumno->_orden_nacimiento,$alumno->_tipo_parto,$alumno->_numero_parto,$alumno->_multiple_parto,$alumno->_problemas_lenguaje,$alumno->_problemas_vision,$alumno->_problemas_parto,$alumno->_tratamiento_medico,$alumno->_tratamiento_odontologico,$alumno->_tratamiento_psicologico,$alumno->_enfermedades,$alumno->_control_vacunas,$alumno->_alergias,$alumno->_talla,$alumno->_peso,$alumno->_responsable_primeros,$alumno->_beca,$alumno->_canaima);
	}

}

if($modo=='b'){
$alumno->_id = $_REQUEST['id'];
//se busca:
	$kont =$alumno->get_Alumno($alumno->_id);
	if ($kont==-1 ) {
		//si no existe no pasa nada
		$msg=' <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">Registro  '.$alumno->_id.'  No existe</div></td>
		</tr>
		</table>';
		echo $msg;
		//"<h3 text-align: center >Registro  $alumno->_id  No existe </h3>";
		} else {
		//si existe se muestra
		//$alumno->CargarGrupo($alumno->_id);
		echo '<table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
		<TR BGCOLOR="#58ACFA">
		<td colspan="2"><div align="center">';
		echo "Registro para Alumno Id:= $alumno->_id ";
		echo '</div></td></tr>';
		echo '<td colspan="2"><div align="center">';
		echo " Nombre:    $alumno->_nombre  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Apellido:  $alumno->_apellido  </td></tr>";
		echo '<td colspan="2"><div align="center">';
		echo " Cedula Escolar:  $alumno->_ci_escolar  </td></tr></table>";
	}
}


if($modo=='s'){//seleccionar inscripcion
	//debe generar una lista de seleccion con el objeto grilla apuntando a la tabla inscripciones y 
	//devolver el id de la inscripcion seleccionada
	include_once "grillaSeleccion.php";
	$ginscr= new GrillaS;
	$ginscr->set_tabla("alumnos");
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
// instancia de la clase grilla para listar alumnos
include_once "grilla.php";
$ggrupo= new Grilla;
$ggrupo->set_tabla("alumnos");
$ggrupo->set_Manejador("manejoalumnos.php");
$ggrupo->crear_grilla("alumnos",1,'i');
*/
header("location:phpgrid/gridAlumnos.php");

?>


