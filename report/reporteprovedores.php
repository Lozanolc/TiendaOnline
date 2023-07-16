<?php 
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Times','B',20);
    $this->Image('../assets/img/logoHM.png',6,5,200); //imagen(archivo, png/jpg || x,y,tamaño)
    //Configuración de titulo de reporte
    $this->setXY(60,60);
    $this->Cell (100,10,utf8_decode('Reporte de Provedores HM'),0,1,'C');
    //Imagen de fondo
    $this->Image('../assets/img/felipe.png',25,71,160); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->Ln(20);
    $this->SetFont("Times","b",12);
    //Fecha del Sistema
    $this->SetFont("Times","b",13);
    $this->Cell (20,1,utf8_decode('Fecha:'),0,1,'0');
    $this->SetFont('Times','',13);
    //padding izquierda, padding inferior 
    $this->Cell(60,0,date('d/m/Y'),0,1,'C');
    $this->Ln(10);
    //titulo de item
    $this->SetFillColor(12, 130, 255);//colores 
    $this->SetFont("Times","b",12);
    $this->Cell (40,10,utf8_decode('Nombre'),1,0,'C',1);
    $this->Cell (25,10,utf8_decode('Cedula'),1,0,'C',1);
    $this->Cell (25,10,utf8_decode('Telefono'),1,0,'C',1);
    $this->Cell (25,10,utf8_decode('RIF'),1,0,'C',1);
    $this->Cell (75,10,utf8_decode('Direccion'),1,0,'C',1);
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',10);
    // Número de página
    $this->Cell(170,10,'Todos los derechos reservados',0,0,'C',0);
    $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'',0,0,'C');
}
}

//tabla de productos 
$id=$_GET['id'];
$sVenta=ejecutarSQL::consultar("SELECT * FROM producto WHERE id='$id'");
$dVenta=mysqli_fetch_array($sVenta, MYSQLI_ASSOC);
ob_end_clean();
$pdf=new PDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont("Times","B",20);
//Margenes de la tabla (padding izq, ?, ?)
$pdf->SetMargins(10,25,25);
$pdf->SetFillColor(255,255,255);
//Cuadro de datos de Productos
$pdf->SetFont("Times","",10);
$suma=0;
$sDet=ejecutarSQL::consultar("SELECT * FROM proveedor");
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM proveedor");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Cell (40,10,utf8_decode($fila1['NombreProveedor']),1,0,'C');
    $pdf->Cell (25,10,utf8_decode($fila1['NITProveedor']),1,0,'C');
    $pdf->Cell (25,10,utf8_decode($fila1['Telefono']),1,0,'C');
    $pdf->Cell (25,10,utf8_decode($fila1['PaginaWeb']),1,0,'C');
    $pdf->Cell (75,10,utf8_decode($fila1['Direccion']),1,0,'C');
    $pdf->Ln(10);
    mysqli_free_result($consulta);
}


//Firma de Cliente
$pdf->SetFont("Times","b",12);
$pdf->Cell (33,5,utf8_decode(''),0);
$pdf->SetFont("Times","b",12);
$pdf->Output('Factura-#'.$id,'I');
mysqli_free_result($sVenta);
$pdf->AddPage();
mysqli_free_result($sDet);



// Creación del objeto de la clase heredada
$pdf = new PDF();//hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();//añade l apagina / en blanco
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
$pdf->SetX(15);
$pdf->SetFont('Helvetica','B',15);
$pdf->Cell(10,8,'','B',0,'C',0);
$pdf->SetFont('Arial','',12);

$pdf->Output();
?>