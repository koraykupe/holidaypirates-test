<?php
namespace JobBoard\Model;

use JobBoard\DB\Connection;
use JobBoard\Observer\EmailNotifierForModerator;
use JobBoard\Observer\EmailNotifierForUser;
use JobBoard\Observer\Observer;
use JobBoard\Observer\Subject;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Job extends Connection implements Subject
{
    public $title;
    public $description;
    public $email;
    public $user_id;
    protected $mapper;
    protected $connection;
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
     */
    public function __construct($title, $description, $email, $userId)
    {
        parent::__construct();

        $this->mapper = $this->connection->mapper('JobBoard\Model\Entity\JobEntity');

        $this->title = $title;
        $this->description = $description;
        $this->email = $email;
        $this->user_id = $userId;
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

    public function create()
    {
        if ($this->countUsersJobPosts($this->user_id) == 0) {
            $status = 0;
            // If this is first job posting of the user attach email notifier event
            $this->attach(new EmailNotifierForUser($this));
        } else {
            $status = 1;
        }

        $user = $this->mapper->create(
            [
                'title' => $this->title,
                'description' => $this->description,
                'email' => $this->email,
                'user_id' => $this->user_id,
                'status' => $status
            ]
        );

        // Attach email notifier event for moderator
        $this->attach(new EmailNotifierForModerator($user));
        $this->notify();

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->mapper->where('id', $id)->first();
    }

    public function countUsersJobPosts($userId)
    {
        return $this->mapper->where(['user_id' => $userId])->count();
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
