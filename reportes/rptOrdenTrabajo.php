<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias 		= new ServiciosReferencias();
//$serviciosReportes			= new ServiciosReportes();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id				=	$_GET['id'];

$resOrden		=	$serviciosReferencias->traerOrdenesPorOrden($id);

$resVenta		=	$serviciosReferencias->traerVentasPorId(mysql_result($resOrden, 0,'refventas'));


$nroOrden		=	mysql_result($resOrden,0,'nroorden');
$cliente		=	mysql_result($resOrden,0,'nombrecompleto');
$fecha 			=	mysql_result($resOrden,0,'fechacrea');
$usuario		=	mysql_result($resOrden,0,'usuacrea');
$monto			=	mysql_result($resOrden,0,'ordenmontomonto');
$sistema		=	mysql_result($resOrden,0,'sistema');
$roller			=	mysql_result($resOrden,0,'roller');
$tela			=	mysql_result($resOrden,0,'tela');
$telaopcional	=	mysql_result($resOrden,0,'telaopcional');
$ancho			=	mysql_result($resOrden,0,'ancho');
$alto			=	mysql_result($resOrden,0,'alto');
$residuoAlto	=	mysql_result($resOrden,0,'residuotelaalto');
$idsistema		=	mysql_result($resOrden,0,'refsistemas');

if ($idsistema == 3) {
	$alto = $alto - ($residuoAlto / 1000);
}

$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



$pdf = new FPDF();



// Carga de datos

$pdf->AddPage();

$pdf->SetFont('Arial','',11);

$pdf->SetXY(5,3);
$pdf->Cell(32,5,'Nro Orden',1,0,'C',false);

$pdf->SetXY(37,3);
$pdf->Cell(60,5,"Cliente",1,0,'C',false);

$pdf->SetXY(97,3);
$pdf->Cell(25,5,"Fecha",1,0,'C',false);

$pdf->SetXY(122,3);
$pdf->Cell(60,5,"Usuario",1,0,'C',false);

$pdf->SetXY(182,3);
$pdf->Cell(25,5,"Monto",1,0,'C',false);


$pdf->SetXY(5,8);
$pdf->Cell(32,5,strtoupper($nroOrden),1,0,'C',false);

$pdf->SetXY(37,8);
$pdf->Cell(60,5,$cliente,1,0,'L',false);

$pdf->SetXY(97,8);
$pdf->Cell(25,5,$fecha,1,0,'C',false);

$pdf->SetXY(122,8);
$pdf->Cell(60,5,$usuario,1,0,'L',false);

$pdf->SetXY(182,8);
$pdf->Cell(25,5,'$ '.$monto,1,0,'R',false);

/************* orden  *************************/

$pdf->SetFont('Arial','U',14);
$pdf->SetXY(5,20);
$pdf->Cell(90,5,'Sistema',0,0,'L',false);

$pdf->SetXY(100,20);
$pdf->Cell(90,5,'Roller',0,0,'L',false);

$pdf->SetFont('Arial','',14);
$pdf->SetXY(5,27);
$pdf->Cell(90,5,$sistema,0,0,'L',false);

$pdf->SetXY(100,27);
$pdf->Cell(90,5,$roller,0,0,'L',false);

$pdf->SetFont('Arial','U',14);
$pdf->SetXY(5,37);
$pdf->Cell(90,5,'Tela',0,0,'L',false);

$pdf->SetXY(100,37);
$pdf->Cell(90,5,'Tela Opcional',0,0,'L',false);

$pdf->SetFont('Arial','',14);
$pdf->SetXY(5,44);
$pdf->Cell(90,5,$tela,0,0,'L',false);

$pdf->SetXY(100,44);
$pdf->Cell(90,5,$telaopcional,0,0,'L',false);

$pdf->SetFont('Arial','U',14);
$pdf->SetXY(5,54);
$pdf->Cell(90,5,'Ancho',0,0,'L',false);

$pdf->SetXY(100,54);
$pdf->Cell(90,5,'Alto',0,0,'L',false);

$pdf->SetFont('Arial','',14);
$pdf->SetXY(5,61);
$pdf->Cell(90,5,$ancho.' mtrs',0,0,'L',false);

$pdf->SetXY(100,61);
$pdf->Cell(90,5,$alto.' mtrs',0,0,'L',false);

/******************  fin ordenes    *************************/

/******************  Tareas    *************************/
$pdf->SetFont('Arial','U',14);
$pdf->SetXY(5,71);
$pdf->Cell(90,5,'Tareas:',0,0,'L',false);
$pdf->Ln();

$resTareas		= $serviciosReferencias->traerOrdenessistematareasPorOrden($id);

$pdf->SetFont('Arial','',11);
$x = 5;
$y = 81;
$pdf->SetXY(5,81);
$pdf->Cell(90,5,'Tarea',1,0,'C',false);
$pdf->SetXY(95,81);
$pdf->Cell(25,5,'Cumplida',1,0,'C',false);
$pdf->SetXY(120,81);
$pdf->Cell(25,5,'Marcar',1,0,'C',false);

$x = 5;
$y = 86;
while ($row = mysql_fetch_array($resTareas)) {
	$pdf->SetXY(5,$y);
	$pdf->Cell(90,5,$row['tarea'],1,0,'L',false);
	$pdf->SetXY(95,$y);
	$pdf->Cell(25,5,$row['cumplida'],1,0,'L',false);
	$pdf->SetXY(120,$y);
	$pdf->Cell(25,5,'',1,0,'L',false);
	$y += 5;
}


$pdf->SetFont('Arial','',13);

$nombreTurno = "rptOrdenDeTrabajo-".date('Y-m-d').".pdf";

$pdf->Output($nombreTurno,'I');

/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>

