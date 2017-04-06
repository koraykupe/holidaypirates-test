<?php

namespace JobBoard\Validation;

use Symfony\Component\Validator\Validation;

class SymfonyValidator implements Validator
{
    protected $validator;

    public function __construct()
    {
        $this->validator = Validation::createValidatorBuilder();
    }

    public function validate($value, array $constraints)
    {
        return $this->validator->getValidator()->validate($value, $constraints = null);
    }

    public function addMethodMapping($str)
    {
        return $this->validator->addMethodMapping($str);
    }

}