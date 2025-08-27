<?php
// Datos del formulario
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Validación básica
if(empty($name) || empty($email) || empty($subject) || empty($message)){
    die('Por favor completa todos los campos.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Por favor ingresa un email válido.');
}

// Destinatario
$to = 'sacolmenaress@gmail.com';

// Cabeceras
$headers = "From: $name <$email>" . "\r\n";
$headers .= "Reply-To: $email" . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Contenido del mensaje
$email_content = "
    <h3>Nuevo mensaje de contacto</h3>
    <p><strong>Nombre:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Asunto:</strong> $subject</p>
    <p><strong>Mensaje:</strong></p>
    <p>".nl2br(htmlspecialchars($message))."</p>
";

// Enviar correo
if (mail($to, $subject, $email_content, $headers)) {
    echo 'success';
} else {
    echo 'Error al enviar el mensaje.';
}
?>