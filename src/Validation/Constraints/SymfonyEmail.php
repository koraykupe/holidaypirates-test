<?php

namespace JobBoard\Validation\Constraints;

use Symfony\Component\Validator\Constraints\Email as SymfonyEmailConstraint;

class SymfonyEmail implements Email
{
    protected $email;

    public function __construct(array $rules)
    {
        $this->email = new SymfonyEmailConstraint($rules);
    }
}