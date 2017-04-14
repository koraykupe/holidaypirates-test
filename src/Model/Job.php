<?php
namespace JobBoard\Model;

use JobBoard\Observer\Observer;
use JobBoard\Observer\Subject;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Job implements Subject
{
    public $id;
    public $title;
    public $description;
    public $email;
    public $status;
    public $user_id;
    /**
     * @var array
     */
    protected $observers = [];

    /**
     * Job constructor.
     *
     * @param $title
     * @param $description
     * @param $email
     * @param $userId
     * @param int $status
     */
    public function __construct($title, $description, $email, $userId, int $status = 0)
    {
        $this->title = $title;
        $this->description = $description;
        $this->email = $email;
        $this->user_id = $userId;
        $this->status = $status;
    }

    /**
     * Validate input data
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // Title
        $metadata->addPropertyConstraint(
            'title',
            new NotBlank(
                array(
                'message' => 'Title is required.',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'title',
            new Length(
                array(
                'min'        => 3,
                'max'        => 255,
                'minMessage' => 'Job title must be at least {{ limit }} characters long',
                'maxMessage' => 'Job title cannot be longer than {{ limit }} characters',
                )
            )
        );

        // Description
        $metadata->addPropertyConstraint(
            'description',
            new NotBlank(
                array(
                'message' => 'Description is required.',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'description',
            new Length(
                array(
                'min'        => 10,
                'max'        => 50000,
                'minMessage' => 'Job description must be at least {{ limit }} characters long',
                'maxMessage' => 'Job description cannot be longer than {{ limit }} characters',
                )
            )
        );

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
        $metadata->addPropertyConstraint(
            'description',
            new Length(
                array(
                'max'        => 255,
                'maxMessage' => 'Job description cannot be longer than {{ limit }} characters',
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
