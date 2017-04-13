<?php

namespace JobBoard\Validation\Constraints;

use Symfony\Component\Validator\Constraints\Email as SymfonyEmailConstraint;

/**
 * Class SymfonyEmail
 *
 * @package JobBoard\Validation\Constraints
 */
class SymfonyEmail implements Email
{
    /**
     * @var SymfonyEmailConstraint
     */
    protected $email;

    /**
     * SymfonyEmail constructor.
     *
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->email = new SymfonyEmailConstraint($rules);
    }
}
