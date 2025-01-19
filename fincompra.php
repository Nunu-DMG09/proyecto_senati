<?php
session_start();
include("conectar.php");

try {
    // Obtener el último pedido realizado (sin necesidad de cliente/usuario)
    $stmt = $pdo->prepare("SELECT * FROM pedido ORDER BY id_pedido DESC LIMIT 1");
    $stmt->execute();
    $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra un pedido, mostrar un mensaje y detener el proceso
    if (!$pedido) {
        echo "No se encontró el pedido.";
        exit();
    }

    // Obtener los detalles del pedido
    $stmt = $pdo->prepare("SELECT dp.*, p.nombre_producto AS producto_nombre 
                           FROM detalle_pedido dp 
                           JOIN producto p ON dp.id_producto = p.id_producto 
                           WHERE dp.id_pedido = ?");
    $stmt->execute([$pedido['id_pedido']]);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "BIEN!";
} catch (PDOException $e) {
    die("Error al obtener los detalles del pedido: " . $e->getMessage());
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SENATI</title>
  
  <!-- Enlaces a Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Enlaces a Bulma CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Enlace al icono del restaurante -->
  <link rel="icon" href="IMG/senatilogo.png" type="image/png">
  <link rel="stylesheet" href="fincompras.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet"> <!-- Fuente para títulos -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente para párrafos -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: white;">
    <div class="container-fluid">
      <a class="navbar-brand" href="principal.html">
        <img src="IMG/Logo-senati.jpg" alt="Senati" class="logo-senati">
        <span class="logo-text">SENATI</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="platos.php">
              <img src="IMG/plato.jpg" alt="plato"> Platos</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="#CONTACTO">
              <img src="IMG/telefono2.jpg" alt="telefono"> Contáctanos</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="shop.php">
              <img src="IMG/navcarro.png" alt="carro"></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<br>
<br>

<main class="main-content d-flex position-relative flex-wrap" id="main">
    <!-- Container para subdividir en dos secciones el main -->
    <div class="container container-compra">
        <h2 class="mb-4 compra-title">¡Compra realizada con éxito!</h2>
        <h4 class="mb-3 compra-subtitle">Detalles de tu pedido:</h4>
        
        <p><strong>Código de Pedido:</strong> <?php echo htmlspecialchars($pedido['id_pedido']); ?></p>
        <p><strong>Fecha de Pedido:</strong> <?php echo date("Y-m-d", strtotime($pedido['fecha_pedido'])); ?></p>
        <p><strong>Total:</strong> S/. <?php echo number_format($pedido['total'], 2); ?></p>
        <h5 class="mt-3 compra-subtitle">Productos Comprados:</h5>
        <table class="table compra-tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $totalPedido = 0;  // Variable para almacenar el total de la compra
                    foreach ($productos as $item) { 
                        $totalProducto = $item['precio_unitario'] * $item['cantidad'];
                        $totalPedido += $totalProducto; // Sumar al total de la compra
                ?>
                    <tr>
                        <td class="marcado"><?php echo htmlspecialchars($item['producto_nombre']); ?></td>
                        <td><?php echo $item['cantidad']; ?></td>
                        <td class="marcado">S/. <?php echo number_format($item['precio_unitario'], 2); ?></td>
                        <td>S/. <?php echo number_format($totalProducto, 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <!-- Fila para mostrar el total de la compra -->
        <div class="text-right">
            <h5>Total de la Compra: S/. <?php echo number_format($totalPedido, 2); ?></h5>
        </div>
        
        <h4 class="mt-4 compra-title">Gracias por tu compra!! </h4>
        <!-- Botón para volver a la tienda -->
        <a href="platos.php" class="btn btn-primary mt-3">Volver a comprar</a>
        <a href="generarpdf.php" class="btn btn-success mt-3">Imprimir PDF</a>
    </div>
</main>


  <footer id="CONTACTO">
    <!-- Sección de contacto -->
    <div class="contacto">
        <h3>Contáctanos</h3>
        <p><strong>Dirección:</strong> Av, Juan Tomis Stack N° 990, Chiclayo 14011</p>
        <p><strong>Teléfono:</strong> (074) 202473</p>
        <p><strong>Horario de atención:</strong> Lunes a Sabado: 12:00 PM - 17:30 PM</p>
    </div>
  
    <!-- Sección de redes sociales -->
    <div class="redes-sociales">
        <h3>Redes Sociales</h3>
        <a href="https://www.facebook.com" target="_blank">
          <img src="IMG/facebook2.jpg" alt="Facebook">
      </a>
      <a href="https://www.instagram.com" target="_blank">
          <img src="IMG/instagram.png" alt="Instagram">
      </a>
      <a href="https://www.x.com" target="_blank">
          <img src="IMG/x.png" alt="X">
      </a>
    </div>
  
    <!-- Sección de políticas -->
    <div class="politicas">
        <h3>Políticas</h3>
        <a href="#terminos-condiciones">Términos & Condiciones</a>
        <a href="#politica-privacidad">Política de Privacidad</a>
        <a href="#tratamiento-datos">Política de Tratamiento de Datos</a>
    </div>
  </footer>
  
  <!-- Texto pequeño del footer -->
  
  <footer class="bg-light py-3">
    <p class="text-center">&copy; 2024 Restaurante La Sazón - Todos los derechos reservados</p>
  </footer>
  <script src="carAlert.js"></script>
  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
