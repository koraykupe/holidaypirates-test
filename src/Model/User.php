<?php
namespace JobBoard\Model;

use JobBoard\Observer\Observer;
use JobBoard\Observer\Subject;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User implements Subject
{
    public $email;
    public $password;
    public $isManager;

    /**
     * @var array
     */
    protected $observers = [];

    /**
     * User constructor.
     * @param $email
     * @param $password
     * @param $isManager
     */
    public function __construct($email, $password, int $isManager = 0)
    {
        $this->email = $email;
        $this->password = $password;
        $this->isManager = $isManager;
    }

    /**
     * Validate input data
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // Email
        $metadata->addPropertyConstraint(
            'email',
            new NotBlank(
                array(
                'message' => 'Email is required.',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'email',
            new Email(
                array(
                    'message' => 'The email {{ value }} is not a valid email.',
                    'checkMX' => false,
                )
            )
        );

        // Password
        $metadata->addPropertyConstraint(
            'password',
            new Length(
                array(
                'min'        => 5,
                'max'        => 20,
                'minMessage' => 'Password must be at least {{ limit }} characters long',
                'maxMessage' => 'Password cannot be longer than {{ limit }} characters',
                )
            )
        );
    }

    /**
     * @param Observer $observer
     * @return $this
     */
    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
        return $this;
    }

    /**
     * @param $index
     * @return bool
     */
    public function detach($index)
    {
        unset($this->observers[$index]);
        return true;
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->handle();
        }
    }
}
