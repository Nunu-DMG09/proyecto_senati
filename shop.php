<?php 
session_start();
include("conectar.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina Web - Comedor de Senati</title>
  
  <!-- Enlaces a Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Enlaces a Bulma CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
  <!-- Enlace al icono del restaurante -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!--Google Fonts-->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet"> <!-- Fuente para títulos -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente para párrafos -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="shop.css">
  
</head>
<body>
  <!-- Barra de navegación -->
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

  

  <main class="main-content d-flex position-relative flex-wrap" id="main">
    <div class="container carrito-container">
        <h2 class="carrito-title">Carrito de Compras</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <table class="table carrito-tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item):
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                    ?>
                        <tr>
                            <td class="marcado"><?= htmlspecialchars($item['name']) ?></td>
                            <td>S/. <?= number_format($item['price'], 2) ?></td>
                            <td class="marcado"><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>S/. <?= number_format($item_total, 2) ?></td>
                            <td>
                                <!-- Formulario para eliminar el producto -->
                                <form action="eliminarpro.php" method="post" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                                    <button type="submit" name="remove_item" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td class="marcado"><strong>S/. <?= number_format($total_price, 2) ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- Finalizar compra -->
            <form action="guardarcarrito.php" method="post" class="finalizar-compra-form">
                <button type="submit" name="checkout" class="btn btn-success btn-comprar">Finalizar Compra</button>
            </form>
        <?php else: ?>
            <p class="carrito-vacio">Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>
</main>



<footer id="CONTACTO">
  <!-- Sección de contacto -->
  <div class="contacto">
      <h3>Contáctanos</h3>
      <p><strong>Dirección:</strong> Av, Juan Tomis Stack N° 990, Chiclayo 14011</p>
      <p><strong>Teléfono:</strong> (074) 202473</p>
      <p><strong>Horario de atención:</strong> Lunes a Sabado: 12:00 AM - 17:30 PM</p>
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

<footer class="bg-light text-center py-3">
  <p>&copy; 2024 Restaurante La Sazón - Todos los derechos reservados</p>
</footer>



  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>