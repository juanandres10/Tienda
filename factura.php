<?php
include 'global/config.php';
include 'global/conexion.php';
require 'fpdf/fpdf.php';
define('EURO',chr(128));

if ($_POST) {
	//sentencias
	
	$IDVENTA = $_POST['IDVENTA'];
	$sentencia = $pdo->prepare("SELECT * from tbldetalleventa, tblproductos where tbldetalleventa.idProducto=tblproductos.id and tbldetalleventa.idVenta=:Id;");
	$sentencia->bindParam(":Id", $IDVENTA);
	$sentencia->execute();
	$listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
}

class PDF extends FPDF{
	// Cabecera de página
	function Header(){
	    // Logo
	    $this->Image('img/escudo_barca.png',10,8,33);
	    // Arial bold 15
	    $this->SetFont('Arial','B',25);
	    // Movernos a la derecha
	    $this->Cell(80);
	    // Título
	    $this->Cell(100,10,'Futbol Club Barcelona',1,0,'C');
	    // Salto de línea
	    $this->Ln(40);
	}

	// Pie de página
	function Footer(){
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,'Tienda oficial del Futbol Club Barcelona '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

		//print_r($lista['nombre']);
		
	
//Creamos un objeto de la clase PDF
$pdf = new PDF();
//Define el numero de paginas
$pdf->AliasNbPages();
//Añadimos paginas a nuestro pdf
$pdf->AddPage();
//Indicamos la fuente que queremos y tamaño
$pdf->SetFont('Times','',20);
//Escribimos en el PDF
$pdf->Cell(100, 10, 'Factura de compra', 0, 'L');
//Salto de linea
$pdf->Ln(20);
//Header de la tabla
//Indicamos la fuente que queremos y tamaño
$pdf->SetFont('Times','',12);
//Color de relleno de la tabla
$pdf->SetFillColor(255,255,255);
//Color del texto
$pdf->SetTextColor(40,40,40);
//Color usado para oferaciones de graficaion
$pdf->SetDrawColor(88,88,88);
//Añadimos la cabecera de nuestra tabla
$pdf->Cell(60, 10, "Producto", 0, 0, "L", 1);
$pdf->Cell(15, 10, "Cantidad", 0, 0, "C", 1);
$pdf->Cell(20, 10, "Precio", 0, 0, "R", 1);
$pdf->Cell(40, 10, "Precio Total", 0, 0, "R", 1);
//Color usado para oferaciones de graficaion
$pdf->SetDrawColor(61,174,233);
//Ancho de la linea
$pdf->SetLineWidth(1);
//Traza una linea entre dos puntos
$pdf->Line(12,85,150,85);
//Color del texto
$pdf->SetTextColor(0,0,0);
//Color de relleno de la tabla
$pdf->SetFillColor(240,240,240);
//Color del texto
$pdf->SetTextColor(40,40,40);
//Color usado para oferaciones de graficaion
$pdf->SetDrawColor(255,255,255);
//Salto de linea
$pdf->Ln(20);
//Creamos variable total
$total=0;
//Recoreemos el bucle
foreach ($listaProductos as $lista) {
//$pdf->MultiCell(100, 20, $lista['nombre'], 1);
$pdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', $lista['nombre']), 0, 0, "L", 1);
$pdf->Cell(15, 10, $lista['cantidad'], 0, 0, "R", 1);
$pdf->Cell(20, 10, $lista['precio'], 0, 0, "R", 1);
$pdf->Cell(40, 10, number_format($lista['cantidad'] * $lista['precio'],2), 0, 0, "R", 1);
//Salto de linea
$pdf->Ln();
//Variable total tiene ya el valor total de la compra
$total=$total + ($lista['cantidad'] * $lista['precio']);
}
//Salto de linea
$pdf->Ln(10);
//Indicamos la fuente que queremos y tamaño
$pdf->SetFont('Courier','B',20);
//Color de relleno de la tabla
$pdf->SetFillColor(242,59,23);
//Color del texto
$pdf->SetTextColor(59,145,244);
//Color usado para oferaciones de graficaion
$pdf->SetDrawColor(88,88,88);
$pdf->Cell(135, 10, "Cantidad total a pagar ".$total." ".EURO, 0, 0, "R", 1);
//$pdf->Cell(100, 10, $lista['nombre'], 0, 'L');
//Se cierra el documento y se envia al navegador
$pdf->Output();
	
?>