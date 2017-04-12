<?php
namespace JobBoard\Observer;
use JobBoard\Model\Job;

/**
 * Class EmailNotifierForUser
 * @package JobBoard\Observer
 */
class EmailNotifierForUser implements Observer
{
    protected $job;
    private $mail;

    public function __construct(Job $job)
    {
        $this->job = $job;
        $this->mail = new \PHPMailer();
        $this->mail->isSMTP(); // or $this->mail->isSendmail();
        $this->mail->Host = 'localhost';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Host = 'mail.cpturkiye.com';
        $this->mail->Username = 'web.cpturkiye';                 // SMTP username
        $this->mail->Password = 'Cps*.web2017';                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 465;                                    // TCP port to connect to
        $this->mail->Timeout = 5;
        $this->mail->SMTPAutoTLS = true;
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->setFrom('web.cpturkiye@cpturkiye.com');
        $this->mail->addAddress($this->job->email);
    }

    /**
     * @return bool
     */
    public function handle()
    {
        try {
            $this->mail->Subject = 'Your submission is in moderation';
            $this->mail->Body    = 'Thank you for job posting. Your submission is in moderation. A moderator will review it.';
            $this->mail->send();
        } catch (\phpmailerException $e) {
            return $e->errorMessage();
        }
        return true;
    }

}