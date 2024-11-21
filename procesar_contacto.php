<?php
include 'db/conexion.php' ;

// Verifica que los datos lleguen mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida y sanitiza los datos recibidos del formulario
    $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_STRING);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);

    // Comprueba que no falten datos obligatorios
    if (empty($fecha) || empty($correo) || empty($nombre) || empty($asunto) || empty($comentario)) {
        echo "Todos los campos son obligatorios. Por favor, vuelve atrás y completa el formulario.";
        exit;
    }

    try {
        // Instancia de la clase DBGestionLibreria
        $gestionLibreria = new DBGestionLibreria();

        // Inserta los datos en la base de datos
        $gestionLibreria->insertarContacto($fecha, $correo, $nombre, $asunto, $comentario);

        // Muestra un mensaje de éxito y redirige al usuario a otra página (opcional)
        echo "<h1>Contacto registrado exitosamente</h1>";
        echo "<p>Gracias por ponerte en contacto con nosotros, $nombre. Te responderemos lo antes posible.</p>";
        echo '<a href="index.php">Volver al inicio</a>';
    } catch (Exception $e) {
        // Muestra un mensaje de error si algo falla
        echo "Ocurrió un error al registrar el contacto: " . $e->getMessage();
    }
} else {
    // Muestra un mensaje si se intenta acceder al archivo directamente
    echo "Acceso no autorizado.";
}
?>
