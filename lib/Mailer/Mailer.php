<?php
namespace Mailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    public function phpMailer($mail, $from, $name, $subject, $message) {
        try {
            $mail->SMTPDebug = 0;                                 // No Debug
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';                       // Using Google SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'kandrupr.github@gmail.com';        // My User
            $mail->Password = 'MY_PASS';                          // My Pass
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;                                    // Encryption port

            $mail->setFrom($from, $name);                         // Sender
            $mail->addAddress($this->myEmail);                    // Me

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = <<<MSG
<html>
<p>From: $name at $from</p>
<p>$message</p>
</html>
MSG;
            $mail->AltBody = "From: $name at $from\n$message";
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private $myEmail = "kandrupr.github@gmail.com";
}