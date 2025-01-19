<?php
session_start();
include("conectar.php");

function generarIdPedido() {
    $prefijo = "PED";  
    $archivoId = 'contador_id.txt';  // Archivo donde se guarda el último contador

    // Verificar si el archivo de contador existe
    if (!file_exists($archivoId)) {
        // Si no existe el archivo, lo creamos e iniciamos el contador en 1
        file_put_contents($archivoId, '1');
        $contador = 1;
    } else {
        // Leer el último contador desde el archivo
        $contador = (int)file_get_contents($archivoId);
    }

    // Incrementar el contador
    $contador++;

    // Formatear el contador a 3 dígitos (p.ej. 001, 002, ..., 999)
    $contadorFormateado = str_pad($contador, 3, "0", STR_PAD_LEFT);

    // Crear el ID con el prefijo y el contador formateado
    $id = $prefijo . $contadorFormateado;

    // Guardar el nuevo contador en el archivo
    file_put_contents($archivoId, $contador);

    return $id;
}
$id = generarIdPedido();
$id_pedido=$id;

function generateIdDetalles() {
    $id = "";
    for ($i = 0; $i < 4; $i++) {
        $id.= rand(0, 9); 
    } 
    return $id;      
}

if(empty($_SESSION['cart'])){

    echo "<script>
    
    alert('No hay productos en el carrito.');
    window.location = 'platos.php';
    ";
    exit();
}

$total = 0;

try{

    
    // Asegúrate de que $fecha_pedido esté en el formato correcto 'YYYY-MM-DD'
    // Si $fecha_pedido está en formato 'DD/MM/YYYY', lo convertimos a 'YYYY-MM-DD'
    $fecha_pedido = date('YmdHis');

    $stmt = $pdo->prepare("INSERT INTO pedido (id_pedido, fecha_pedido, total) VALUES (?,?,?)");
    $stmt->execute([$id_pedido, $fecha_pedido, $total]);

    foreach ($_SESSION['cart'] as $item){
        $id_detalle = generateIdDetalles();
        $total += $item['price'] * $item['quantity'];

        $stmt = $pdo ->prepare('INSERT INTO detalle_pedido (id_detalle_pedido, id_pedido, id_producto, cantidad, precio_unitario) VALUES (?,?,?,?,?)');
        $stmt->execute([$id_detalle,$id_pedido, $item['id'], $item['quantity'], $item['price']]);

    }

    // Actualizar el total del pedido
    $stmt = $pdo->prepare("UPDATE pedido SET total = ? WHERE id_pedido = ?");
    $stmt->execute([$total, $id_pedido]);

    // Vaciar el carrito después de guardar los datos
    unset($_SESSION['cart']);
    echo "datos correctos";

    // Redirigir a la página de finalización de compra
    header("Location: fincompra.php");
    exit();

} catch (PDOException $e) {
    die("Error al procesar el carrito: " . $e->getMessage());
}




