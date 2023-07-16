<?php
session_start();
require './fpdf/fpdf.php';
include '../library/configServer.php';
include '../library/consulSQL.php';
$id=$_GET['id'];
$sVenta=ejecutarSQL::consultar("SELECT * FROM venta WHERE NumPedido='$id'");
$dVenta=mysqli_fetch_array($sVenta, MYSQLI_ASSOC);
$sCliente=ejecutarSQL::consultar("SELECT * FROM cliente WHERE NIT='".$dVenta['NIT']."'");
$dCliente=mysqli_fetch_array($sCliente, MYSQLI_ASSOC);
class PDF extends FPDF{
}
ob_end_clean();
$pdf=new PDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont("Times","",20);
//Margenes izquierda, 
$pdf->SetMargins(25,25,25);
$pdf->SetFillColor(255,255,255);
$pdf->Image('../assets/img/logoHM.png',6,5,200);
$pdf->Ln(50);
$pdf->SetFont("Times","",14);
$pdf->Cell (0,5,utf8_decode('Factura de pedido N°'.$id),0,1,'C');
$pdf->Ln(15);
//Fecha de Pedido
$pdf->SetFont("Times","b",12);
$pdf->Cell (33,5,utf8_decode('Fecha del pedido: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (37,5,utf8_decode($dVenta['Fecha']),0);
$pdf->Ln(8);
$pdf->SetFont("Times","b",12);
//Nombre de Cliente
$pdf->Cell (37,5,utf8_decode('Nombre del cliente: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (100,5,utf8_decode($dCliente['NombreCompleto']." ".$dCliente['Apellido']),0);
$pdf->Ln(8);
$pdf->SetFont("Times","b",12);
//datos de Cedula del Cliente (margen de izquierda a derecha, )
$pdf->Cell (20,5,utf8_decode('Cédula:'),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (25,5,utf8_decode($dCliente['NIT']),0);
$pdf->Ln(8);
$pdf->SetFont("Times","b",12);
$pdf->Cell (19,5,utf8_decode('Telefono: '),0);
$pdf->SetFont("Times","",12);
$pdf->Cell (70,5,utf8_decode($dCliente['Telefono']),0);
$pdf->SetFont("Times","b",12);
$pdf->Ln(20);
//foto de fondo
$pdf->Image('../assets/img/felipe.png',25,71,160);
//Cuadro de datos de Pedido
$pdf->SetFillColor(12, 130, 255);
$pdf->SetFont("Times","b",12);
$pdf->Cell (76,10,utf8_decode('Nombre'),1,0,'C',1);
$pdf->Cell (30,10,utf8_decode('Precio'),1,0,'C',1);
$pdf->Cell (30,10,utf8_decode('Cantidad'),1,0,'C',1);
$pdf->Cell (30,10,utf8_decode('Subtotal'),1,0,'C',1);
$pdf->Ln(10);
$pdf->SetFont("Times","",12);
$suma=0;
$sDet=ejecutarSQL::consultar("SELECT * FROM detalle WHERE NumPedido='".$id."'");
while($fila1 = mysqli_fetch_array($sDet, MYSQLI_ASSOC)){
    $consulta=ejecutarSQL::consultar("SELECT * FROM producto WHERE CodigoProd='".$fila1['CodigoProd']."'");
    $fila=mysqli_fetch_array($consulta, MYSQLI_ASSOC);
    $pdf->Cell (76,10,utf8_decode($fila['NombreProd']),1,0,'C');
    $pdf->Cell (30,10,utf8_decode('$'.$fila1['PrecioProd']),1,0,'C');
    $pdf->Cell (30,10,utf8_decode($fila1['CantidadProductos']),1,0,'C');
    $pdf->Cell (30,10,utf8_decode('$'.$fila1['PrecioProd']*$fila1['CantidadProductos']),1,0,'C');
    $pdf->Ln(10);
    $suma += $fila1['PrecioProd']*$fila1['CantidadProductos'];
    mysqli_free_result($consulta);
}
$pdf->SetFont("Times","b",12);
$pdf->Cell (106,10,utf8_decode(''),1,0,'C');
$pdf->Cell (30,10,utf8_decode('Total '),1,0,'C');
$pdf->Cell (30,10,utf8_decode('$'.number_format($suma,2)),1,0,'C');
$pdf->Ln(60);
//Firma de Cliente
$pdf->SetFont("Times","b",12);
$pdf->Cell (33,5,utf8_decode(''),0);
$pdf->Cell (33,5,utf8_decode('Firma de cliente:          _______________'),0);
$pdf->SetFont("Times","",12);
$pdf->Ln(8);
$pdf->SetFont("Times","b",12);
$pdf->Output('Factura-#'.$id,'I');
mysqli_free_result($sVenta);
mysqli_free_result($sCliente);
mysqli_free_result($sDet);




