<?php
namespace JobBoard\Observer;

/**
 * Class EmailNotifier
 * @package JobBoard\Observer
 */
class EmailNotifier implements Observer
{
    /**
     * @return bool
     */
    public function handle()
    {
        $mail = new \PHPMailer();

        // $mail->isMail();
        // $mail->isSendmail();

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'localhost';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = false;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('koray@koraykupe.com.tr');
        $mail->addAddress('koray@koraykupe.com.tr');

        // $mail->isHTML(true);

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}