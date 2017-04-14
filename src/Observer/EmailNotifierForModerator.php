<?php declare(strict_types = 1);

namespace JobBoard\Observer;

use JobBoard\Config\HassankhanConfig;
use JobBoard\Model\Job;
use JobBoard\Repositories\UserRepository;

/**
 * Class EmailNotifierForModerator
 *
 * @package JobBoard\Observer
 */
class EmailNotifierForModerator implements Observer
{
    protected $job;
    private $mail;
    protected $config;
    protected $userRepository;

    /**
     * EmailNotifierForModerator constructor.
     * @param Job $job
     * @param UserRepository $userRepository
     */
    public function __construct(Job $job, UserRepository $userRepository)
    {
        $this->job = $job;
        $this->userRepository = $userRepository;
        $this->config = new HassankhanConfig();
        $this->mail = new \PHPMailer();
        $this->mail->isSMTP(); // or $this->mail->isSendmail();
        $this->mail->Host = $this->config->get('email.host');  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true; // Enable SMTP authentication
        $this->mail->Username = $this->config->get('email.username');  // SMTP username
        $this->mail->Password = $this->config->get('email.password'); // SMTP password
        $this->mail->SMTPSecure = $this->config->get('email.smtp_secure'); // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = $this->config->get('email.port');  // TCP port to connect to
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

        $moderators = $this->userRepository->getAllModerators();
        foreach ($moderators as $moderator) {
            $this->mail->addAddress($moderator['email']);
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
            $emailText  .= '<a href="'.$this->config->get('url').'/job/approve/'.$this->job->id.'">Approve</a> or ';
            $emailText  .= '<a href="'.$this->config->get('url').'/job/spam/'.$this->job->id.'">Mark as Spam</a>';

            $this->mail->msgHTML($emailText);
            $this->mail->send();
        } catch (\phpmailerException $e) {
            return $e->errorMessage();
        }
        return true;
    }
}
