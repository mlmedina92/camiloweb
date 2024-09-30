<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Llamar a la función si la request es de tipo POST
    sendEmail();
}

function sendEmail()
{
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    // Configurar la instancia de PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'mail.smtp2go.com';  // Host del servidor SMTP
    $mail->SMTPAuth = true;                 // Habilitar autenticación SMTP
    $mail->Username = 'webform@camilocapital.es'; // Tu dirección de correo electrónico
    $mail->Password = 'NFu6J9OSLYgzh8Ot';       // Tu contraseña de correo electrónico
    $mail->SMTPSecure = 'tls';               // Habilitar cifrado TLS
    $mail->Port = 2525 ;                       // Puerto SMTP

    // Configurar el contenido del correo electrónico
    $mail->setFrom($email, $nombre);
    $mail->addAddress('informacion@camilocapital.es', 'Camilo Capital');
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;

    // Procesar el envío del correo electrónico
    if (!$mail->send()) {
        echo 'El mensaje no pudo ser enviado. Por favor, utilice nuestros medios de contacto alternativos para resolver su consulta.'; //por alguna razon este comentario no se imprime en el HTML. Pendiente de investigar. DP
        echo 'Error: ' . $mail->ErrorInfo;
	sleep(1);
	header("Location: https://www.camilocapital.es"); // Redirijo al homepage.
	exit();
    } else {
        echo 'El mensaje ha sido enviado exitosamente. Usted está siendo redirigido a la página anterior.';  //por alguna razon este comentario no se imprime en el HTML. Pendiente de investigar
	sleep(1);
        header("Location: https://www.camilocapital.es"); // Redirijo al homepage.
	exit();
    }
}
?>
