<?php
ob_start(); // Iniciar el almacenamiento en búfer de salida

session_start();
include("PDF/fpdf.php"); // Incluye FPDF correctamente
include("conectar.php");

try {
    // Obtener el último pedido realizado
    $stmt = $pdo->prepare("SELECT * FROM pedido ORDER BY id_pedido DESC LIMIT 1");
    $stmt->execute();
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pedido) {
        die("No se encontró el pedido.");
    }

    // Obtener los detalles del pedido
    $stmt = $pdo->prepare("SELECT dp.*, p.nombre_producto AS producto_nombre 
                           FROM detalle_pedido dp 
                           JOIN producto p ON dp.id_producto = p.id_producto 
                           WHERE dp.id_pedido = ?");
    $stmt->execute([$pedido['id_pedido']]);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear un PDF con FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    // Encabezado del PDF
    $pdf->Cell(0, 10, 'Detalles del Pedido', 0, 1, 'C');
    $pdf->Ln(10);

    // Información del pedido
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'ID Pedido: ' . $pedido['id_pedido'], 0, 1);
    $pdf->Cell(40, 10, 'Fecha: ' . $pedido['fecha_pedido'], 0, 1); 
    $pdf->Ln(10);

    // Encabezado de la tabla de productos
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(40, 10, 'Precio Unitario', 1);
    $pdf->Cell(40, 10, 'Total', 1);  
    $pdf->Ln();

    // Inicializar la variable para la suma total
    $sumaTotal = 0;

    // Datos de los productos
    $pdf->SetFont('Arial', '', 12);
    foreach ($productos as $producto) {
        $total = $producto['cantidad'] * $producto['precio_unitario'];  // Cálculo del total
        $sumaTotal += $total; // Acumula el total

        $pdf->Cell(50, 10, $producto['producto_nombre'], 1);
        $pdf->Cell(30, 10, $producto['cantidad'], 1);
        $pdf->Cell(40, 10, number_format($producto['precio_unitario'], 2), 1);
        $pdf->Cell(40, 10, number_format($total, 2), 1);  // Muestra el total
        $pdf->Ln();
    }

    // Mostrar la suma total al final de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(120, 10, 'Total Pedido', 1);
    $pdf->Cell(40, 10, number_format($sumaTotal, 2), 1);  // Muestra la suma total
    $pdf->Ln();

    // Limpiar el búfer de salida y generar el PDF
    ob_end_clean(); // Limpia el búfer de salida
    $pdf->Output(); // Generar el PDF

} catch (PDOException $e) {
    die("Error al obtener los detalles del pedido: " . $e->getMessage());
}
?>



