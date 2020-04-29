<?php
include 'global/config.php';
include 'global/conexion.php';
require 'fpdf/fpdf.php';

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
//Indicamos la fuente que queremos y tamaño
$pdf->SetFont('Times','',12);
//Recoreemos el bucle
foreach ($listaProductos as $lista) {
$pdf->MultiCell(100, 20, $lista['nombre'], 1);
}
//$pdf->Cell(100, 10, $lista['nombre'], 0, 'L');
//Se cierra el documento y se envia al navegador
$pdf->Output();
	
?>