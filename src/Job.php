<?php
namespace JobBoard;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Job
{
    public $title;
    public $description;
    public $email;
    public $status;

    /**
     * Job constructor.
     * @param $title
     * @param $description
     * @param $email
     */
    public function __construct($title, $description, $email, int $status=0)
    {
        $this->title = $title;
        $this->description = $description;
        $this->email = $email;
        $this->status = $status;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // Title
        $metadata->addPropertyConstraint('title', new NotBlank(array(
            'message' => 'Title is required.',
        )));
        $metadata->addPropertyConstraint('title', new Length(array(
            'min'        => 3,
            'max'        => 255,
            'minMessage' => 'Job title must be at least {{ limit }} characters long',
            'maxMessage' => 'Job title cannot be longer than {{ limit }} characters',
        )));

        // Description
        $metadata->addPropertyConstraint('description', new NotBlank(array(
            'message' => 'Description is required.',
        )));
        $metadata->addPropertyConstraint('description', new Length(array(
            'min'        => 10,
            'max'        => 50000,
            'minMessage' => 'Job description must be at least {{ limit }} characters long',
            'maxMessage' => 'Job description cannot be longer than {{ limit }} characters',
        )));

        // Email
        $metadata->addPropertyConstraint('email', new NotBlank(array(
            'message' => 'Email is required.',
        )));
        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'The email {{ value }} is not a valid email.',
            'checkMX' => false,
        )));
        $metadata->addPropertyConstraint('description', new Length(array(
            'max'        => 255,
            'maxMessage' => 'Job description cannot be longer than {{ limit }} characters',
        )));
    }
}