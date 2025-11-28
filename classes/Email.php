<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Model\Usuario;


class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST']; // Cambiar por el host SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USER']; // Cambiar por el usuario SMTP
            $mail->Password   = $_ENV['MAIL_PASS']; // Cambiar por la contraseña SMTP    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['MAIL_PORT'];

            // Configuración del correo
            $mail->setFrom('jsostenes@zapotlanejo.tecmm.edu.mx', 'AppSalon'); // Cambiar por el correo del remitente
            $mail->addAddress($this->email, $this->nombre);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Confirma tu cuenta';
            $mail->Body    = "<html>
                                <p>Hola " . $this->nombre . ", confirma tu cuenta en AppSalon.</p>
                                <p>Presiona el siguiente enlace para confirmar tu cuenta:</p>
                                <a href='". $_ENV['APP_URL'] ."/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>
                                <p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>
                             </html>";
            $mail->AltBody = "Hola " . $this->nombre . ", confirma tu cuenta en AppSalon. Visita el siguiente enlace para confirmar tu cuenta: " . $_ENV['APP_URL'] ."/confirmar-cuenta?token=" . $this->token;
            $mail->send();
            echo "Mensaje enviado correctamente";
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    // Método para enviar instrucciones de reestablecimiento de password
    public function enviarInstrucciones() {
        // Crear el objeto de PHPMailer
        $mail = new PHPMailer(true);    

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST']; // Cambiar por el host SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USER']; // Cambiar por el usuario SMTP
            $mail->Password   = $_ENV['MAIL_PASS']; // Cambiar por la contraseña SMTP    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['MAIL_PORT'];

            // Configuración del correo
            $mail->setFrom('jsostenes@zapotlanejo.tecmm.edu.mx', 'AppSalon'); // Cambiar por el correo del remitente
            $mail->addAddress($this->email, $this->nombre);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Reestablece tu password';
            $mail->Body    = "<html>
                                <p>Hola " . $this->nombre . ", has solicitado reestablecer tu password.</p>
                                <p>Presiona el siguiente enlace para reestablecer tu password:</p>
                                <a href='". $_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Reestablecer Password</a>
                                <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                             </html>";
            $mail->AltBody = "Hola " . $this->nombre . ", has solicitado reestablecer tu password. Visita el siguiente enlace para reestablecer tu password: " . $_ENV['APP_URL'] ."/recuperar?token=" . $this->token;
            $mail->send();
            echo "Mensaje enviado correctamente";
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    
}