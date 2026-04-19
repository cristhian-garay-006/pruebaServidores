<?php
error_reporting(0); // Desactivar errores visibles que rompen el JSON
ini_set('display_errors', 0);

header('Content-Type: application/json');

try {
    require_once 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';

        if (empty($name) || empty($email) || empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Por favor completa todos los campos.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Email no válido.']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);
        
        echo json_encode(['status' => 'success', 'message' => '¡Mensaje enviado con éxito! Nos pondremos en contacto pronto.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
    }
} catch (Throwable $e) {
    // Capturamos CUALQUIER error (PHP 7+) y lo devolvemos como JSON
    echo json_encode([
        'status' => 'error', 
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
}
?>
