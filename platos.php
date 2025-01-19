<?php 
session_start();
include("conectar.php");

// Verifica si la variable $pdo está definida
if (!isset($pdo)) {
    die("No se pudo establecer una conexión con la base de datos.");
}

try {
    // Consulta para obtener todos los productos de la tabla 'productos'
    $query = $pdo->query("SELECT * FROM producto");
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al ejecutar la consulta: " . $e->getMessage());
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
  <link rel="stylesheet" href="platos.css">
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

<main class="main-content d-flex position-relative flex-wrap" id="main">
        
        <div class="container" style="margin-top: 120px;">
        <h2 class="title has-text-centered">Nuestros Platos</h2>
            <div class="container">
                <div class="row">
                    <?php
                    // Verifica que haya productos disponibles
                    if (empty($productos)) {
                        echo "<p>No hay productos disponibles.</p>";
                    } else {
                        // Bucle para mostrar todos los productos
                        foreach ($productos as $producto) {
                    ?>
                            
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card">
                                    <img src="<?php echo htmlspecialchars($producto['imagen_url']); ?>" class="card-img-top img-catalog" alt="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                                    <div class="card-body">
                                        <p class="card-text text-center"><?php echo htmlspecialchars($producto['nombre_producto']); ?></p>
                                        <p class="card-text text-center text-muted"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                        <h5 class="card-title text-center">S/. <?php echo number_format($producto['precio'], 2); ?></h5>
                                        <form id="addToCartForm<?php echo $producto['id_producto']; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $producto['id_producto']; ?>">
                                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>">
                                            <input type="hidden" name="product_price" value="<?php echo number_format($producto['precio'], 2); ?>">
                                            <input type="hidden" name="product_quantity" value="1">
                                            <button type="button" class="btn btn-outline-primary btn-cart ms-3 add-to-cart-btn"
                                                onclick="addToCart('<?php echo $producto['id_producto']; ?>')">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
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
  
  <footer class="bg-light py-3">
    <p class="text-center">&copy; 2024 Restaurante La Sazón - Todos los derechos reservados</p>
  </footer>
  <script src="carAlert.js"></script>
  <!-- Scripts de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>