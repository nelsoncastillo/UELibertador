<?php
/*
 * constancias_inscripcion.php.php
 * 
 * Copyright 2016 root
 * 
 * 
 */

require('../fpdf181/fpdf.php');
header('Content-Type: text/html; charset=ISO-8859-1');
$modo=$_REQUEST['modo'];


if($modo=='a'){
 $idalumno=$_REQUEST['idalumno']; 
 $cedulaescolar=$_REQUEST['cedulaescolar']; 

 //$idalumno=3; 
 //$cedulaescolar=3; 
 
 //Datos de Colegio en tabla colegio
	include_once("colegio.php");
	$Colegio= new Colegio;
	$Colegio->Cargar();

$pdf = new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);
$pdf->Image('../images/Logo_ME.jpeg',10,20,40);
$pdf->Image('../images/Logo_colegio.jpeg',180,20,20);
$pdf->Cell(0,6,' REPUBLICA BOLIVARIANA DE VENEZUELA',0,1,'C');
$pdf->Cell(0,6,  'MINISTERIO DEL PODER POPULAR PARA LA EDUCACION',0,1,'C');
$pdf->Cell(0,6,  utf8_decode($Colegio->_nombre),0,1,'C');
$pdf->Cell(0,6,  utf8_decode($Colegio->_ciudad.' '.$Colegio->_estado),0,1,'C');
$pdf->SetFont('Arial','BU',12);
$pdf->Cell(0,10,'CONSTANCIA DE  INSCRIPCION ',0,1,'C');

$pdf->SetFont('Arial','',12);

include_once("procinscripcion.php");
$ProcInscripcion= new ProcInscripcion;
$ProcInscripcion->Cargar($idalumno);

include_once("grupo.php");
$Grupo= new Grupo;
$Grupo->CargarGrupo($ProcInscripcion->_idgrupo);
$pdf->Cell(150,6,utf8_decode('Inscripcion: '.$Grupo->_grupo.'  '.$Grupo->_periodo),1,1,'C'); 

include_once("inscripcion.php");
$Inscripcion= new Inscripcion;
$Inscripcion->Cargar($ProcInscripcion->_idinscripcion);
$pdf->Cell(150,6,utf8_decode('Fecha Inscripcion: '.$Inscripcion->_fecha_inscripcion_inicial.' Año Escolar '.$Inscripcion->_anno_escolar),0,1,'C'); 

include_once("alumno.php");
$Alumno= new Alumno;
$Alumno->get_Alumno($idalumno);
$pdf->Ln(5);
$pdf->Cell(0,6,utf8_decode('Datos de Alumno: '.$Alumno->_apellido.'  '.$Alumno->_nombre),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Cedula Escolar: '.$Alumno->_ci_escolar.'  Sexo:'.$Alumno->_sexo.' Fecha de Nacimiento: '.$Alumno->_fecha_Nacimiento),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Lugar de Nacimiento: Pais: '.$Alumno->_pais.'  Estado: '.$Alumno->_estado.'  Ciudad: '.$Alumno->_ciudad),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Problemas: Vision: '.$Alumno->_problemas_vision.'  Lenguaje: '.$Alumno->_problemas_lenguaje.'  Nacimiento: '.$Alumno->_problemas_parto),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Tratamiento: Medico: '.$Alumno->_tratamiento_medico.'  Odontologico: '.$Alumno->_tratamiento_odontologico.'  Psicologico: '.$Alumno->_tratamiento_psicologico),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Enfermedades: '.$Alumno->_enfermedades.'  Control Vacunas: '.$Alumno->_control_vacunas.'  Alergias: '.$Alumno->_alergias),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Talla: '.$Alumno->_talla.'  Peso: '.$Alumno->_peso.' kg'),0,1,'I');


include_once("RegistroAlumno.php");
$registroAlumno= new RegistroAlumno;
$registroAlumno->Cargar($idalumno);
//================Procedencia puede no ser util al Liceo ===========================

include_once("procedencia.php");
$Procedencia= new Procedencia;
$Procedencia->Cargar($registroAlumno->_procedencia);

$pdf->Cell(0,6,utf8_decode('Datos de Procedencia: '.$Procedencia->_procedencia.'  Vive Con: '.$Procedencia->_vive_con),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Responsable: '.$Procedencia->_responsable_retirar.' Parentesco: '.$Procedencia->_parentesco),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Contacto Local: '.$Procedencia->_tel_local.'  Celular: '.$Procedencia->_tel_cel.' Otro Tlf: '.$Procedencia->_tel_otro),0,1,'I');

//===================================================================================

include_once("representante.php");
$Representantes= new Representantes;
$Representantes->get_Representante($registroAlumno->_representante);

$pdf->Cell(0,6,utf8_decode('Representante: Cedula:'.$Representantes->_cedula.'  Nombre: '.$Representantes->_nombre.' Apellido: '.$Representantes->_apellido),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Contacto Local: '.$Representantes->_tel_local.'  Celular: '.$Representantes->_tel_cel.' Tlf Trabajo: '.$Representantes->_tel_trabajo),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Oficio: '.$Representantes->_oficio.'  Trabaja en: '.$Representantes->_empresa.' Vive con el alumno: '.$Representantes->_vive_con),0,1,'I');

include_once("vivienda.php");
$Vivienda= new Vivienda;
$Vivienda->Cargar($registroAlumno->_vivienda);

$pdf->Cell(0,6,utf8_decode('Datos de Vivienda: tipo: '.$Vivienda->_tipo.'  ubicacion: '.$Vivienda->_ubicacion.' nombre: '.$Vivienda->_nombre_ubicacion),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Condiciones: '.$Vivienda->_condiciones.'  Via: '.$Vivienda->_ubicacion.' nombre: '.$Vivienda->_nombre_via),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Direccion: '.$Vivienda->_direccion.'  Telefono: '.$Vivienda->_telefono),0,1,'I');

include_once("datoshabitacion.php");
$DatosHabitacion= new DatosHabitacion;
$DatosHabitacion->Cargar($registroAlumno->_habitacion);

$pdf->Cell(0,6,utf8_decode('Estado: '.$DatosHabitacion->_estado.'  Municipio: '.$DatosHabitacion->_municipio.' Parroquia: '.$DatosHabitacion->_parroquia),0,1,'I');
$pdf->Cell(0,6,utf8_decode('Tipo : '.$DatosHabitacion->_tipo_vivienda.'  Zona: '.$DatosHabitacion->_zona),0,1,'I');
//$pdf->Cell(0,6,$varconacento,0,1,'I');

$pdf->Ln(20);
$pdf->Cell(0,6,"  ___________________________________________",0,1,'C');
$pdf->Cell(150,6,utf8_decode('Docente que Inscribe: '.$Inscripcion->_docente),0,1,'C'); 
$pdf->Ln(10);
//$pdf->Cell(0,6,utf8_decode("  PROF. ".$Colegio->_director),0,1,'C');
//$pdf->Cell(0,6,"  DIRECTOR ",0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,6," ________________________________________________________________ ",0,1,'C');
$pdf->Cell(0,6,utf8_decode($Colegio->_direccion),0,1,'C');
$pdf->Cell(0,6,utf8_decode($Colegio->_telefonos),0,1,'C');


$pdf->Output('../Inscripcion/Inscripcion_'.$cedulaescolar.'.pdf','F');

unset($pdf); 

//echo "reportes/Inscripcion_".$cedulaescolar.".pdf";
}

?>

