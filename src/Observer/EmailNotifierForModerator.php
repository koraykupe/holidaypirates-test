<?php
namespace JobBoard\Observer;
use JobBoard\Model\Entity\JobEntity;
use JobBoard\Model\Moderator;

/**
 * Class EmailNotifierForModerator
 * @package JobBoard\Observer
 */
class EmailNotifierForModerator implements Observer
{
    protected $job;
    private $mail;

    public function __construct(JobEntity $job)
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

        $moderator = new Moderator();
        $moderators = $moderator->getAll();
        foreach ($moderators as $moderator) {
            $this->mail->addAddress($moderator->email);
        }
    }

    /**
     * @return bool
     */
    public function handle()
    {
        try {
            $this->mail->Subject = 'New job post';
            $emailText    = "Title: ".$this->job->title."<br />Description: ".$this->job->description."<br /><br />";
            $emailText  .= '<a href="'.$this->url.'/job/approve/'.$this->job->id.'">Approve</a> or ';
            $emailText  .= '<a href="'.$this->url.'/job/spam/'.$this->job->id.'">Mark as Spam</a>';

            $this->mail->msgHTML($emailText);
            $this->mail->send();
        } catch (\phpmailerException $e) {
            return $e->errorMessage();
        }
        return true;
    }

}