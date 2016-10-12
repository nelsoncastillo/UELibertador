<?php
require_once('../fpdf181/code128.php');
require_once('../fpdf181/fpdf.php');
header('Content-Type: text/html; charset=ISO-8859-1');
setlocale (LC_TIME, "es_ES");

$modo=$_REQUEST['modo'];
//$modo='a';

if($modo=='a'){
 $idalumno=$_REQUEST['idalumno']; 
 $cedulaescolar=$_REQUEST['cedulaescolar']; 

// $idalumno=3; 
// $cedulaescolar=3; 
 
 //Datos de Colegio en tabla colegio
	include_once("colegio.php");
	$Colegio= new Colegio;
	$Colegio->Cargar();
$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetMargins(20,20,20);
$pdf->Ln(10);
$pdf->Image('../images/Logo_ME.jpeg',10,20,40);
$pdf->Image('../images/Logo_colegio.jpeg',175,20,20);
$pdf->Cell(0,6,' REPUBLICA BOLIVARIANA DE VENEZUELA',0,1,'C');
$pdf->Cell(0,6,  'MINISTERIO DEL PODER POPULAR PARA LA EDUCACION',0,1,'C');
$pdf->Cell(0,6,  utf8_decode(strtoupper ( $Colegio->_nombre)),0,1,'C');
$pdf->Cell(0,6,  utf8_decode(strtoupper ( $Colegio->_ciudad.' , '.$Colegio->_estado)),0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','BU',12);
$pdf->Cell(0,10,'CONSTANCIA DE  ESTUDIOS ',0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);

include_once("procinscripcion.php");
$ProcInscripcion= new ProcInscripcion;
$ProcInscripcion->Cargar($idalumno);

include_once("grupo.php");
$Grupo= new Grupo;
$Grupo->CargarGrupo($ProcInscripcion->_idgrupo);

include_once("inscripcion.php");
$Inscripcion= new Inscripcion;
$Inscripcion->Cargar($ProcInscripcion->_idinscripcion);

include_once("alumno.php");
$Alumno= new Alumno;
$Alumno->get_Alumno($idalumno);

$pdf->Cell(0,6,utf8_decode('Quien suscribe, Director del "'.$Colegio->_nombre.'" en '.$Colegio->_ciudad),0,1,'L');
$pdf->Cell(0,6,utf8_decode('del Municipio '.$Colegio->_municipio.', en el '.$Colegio->_estado.', por medio de '),0,1,'L');
$pdf->Cell(0,6,utf8_decode('la presente hace constar que el(a) estudiante: '.$Alumno->_apellido.' , '.$Alumno->_nombre),0,1,'L');
$pdf->Cell(0,6,utf8_decode('portador de la cedula de identidad '.$Alumno->_ci_escolar.', para el año escolar '.$Inscripcion->_anno_escolar),0,1,'L');
$pdf->Cell(0,6,utf8_decode('cursa estudios en esta institución de '.$Grupo->_periodo.' en la seccion '.$Grupo->_grupo),0,1,'L');
$pdf->Ln(10);
$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$arrayDias = array( 'Domingo', 'Lunes', 'Martes',
       'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$pdf->Cell(0,6,utf8_decode("Constancia que se expide a petición de parte interesada en $Colegio->_ciudad "),0,1,'L');
$pdf->Cell(0,6,utf8_decode("a los ".date('d')." dias del mes de ".$arrayMeses[date('m')-1]." de ".date('Y')),0,1,'L');
$pdf->Ln(30);

$pdf->Cell(0,6,"  _____________________________________",0,1,'C');
$pdf->Cell(0,6,"  PROF.  $Colegio->_director",0,1,'C');
$pdf->Cell(0,6,"        DIRECTOR DEL PLANTEL",0,1,'C');
$pdf->Ln(70);

$codigo_barra=$Alumno->_ci_escolar.'G'.$Grupo->_grupo.'A'.$Inscripcion->_anno_escolar;
$barra= str_pad($codigo_barra, 24, "0", STR_PAD_LEFT);
//echo $barra;

$pdf->Code128(65,230,$barra,80,20);
$pdf->SetXY(70,250);
$pdf->Write(5,$barra);
$pdf->Ln(2);
//Pie de pagina
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,6," ________________________________________________________________ ",0,1,'C');
$pdf->Cell(0,6,utf8_decode($Colegio->_direccion),0,1,'C');
$pdf->Cell(0,6,utf8_decode($Colegio->_telefonos),0,1,'C');

$pdf->Output('../ConstanciaEstudios/'.$cedulaescolar.'.pdf','F');

unset($pdf); 

}

?>

