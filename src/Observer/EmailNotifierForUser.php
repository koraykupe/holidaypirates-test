<?php
namespace JobBoard\Observer;

use JobBoard\Config\HassankhanConfig;
use JobBoard\Model\Job;

/**
 * Class EmailNotifierForUser
 *
 * @package JobBoard\Observer
 */
class EmailNotifierForUser implements Observer
{
    protected $job;
    private $mail;
    protected $config;

    /**
     * EmailNotifierForUser constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        $this->config = new HassankhanConfig();
        $this->mail = new \PHPMailer();
        $this->mail->isSMTP(); // or $this->mail->isSendmail();
        $this->mail->Host = $this->config->get('email.host');  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = $this->config->get('email.username');                 // SMTP username
        $this->mail->Password = $this->config->get('email.password');                           // SMTP password
        $this->mail->SMTPSecure = $this->config->get('email.smtp_secure');                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = $this->config->get('email.port');                                    // TCP port to connect to
        $this->mail->Timeout = 5;
        $this->mail->SMTPAutoTLS = true;
        $this->mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $this->mail->setFrom($this->config->get('email.set_from'));
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
