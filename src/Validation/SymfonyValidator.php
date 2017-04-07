<?php

namespace JobBoard\Validation;

use Symfony\Component\Validator\Validation;

/**
 * Class SymfonyValidator
 * @package JobBoard\Validation
 */
class SymfonyValidator implements Validator
{
    /**
     * @var \Symfony\Component\Validator\ValidatorBuilderInterface
     */
    protected $validator;

    /**
     * SymfonyValidator constructor.
     */
    public function __construct()
    {
        $this->validator = Validation::createValidatorBuilder();
    }

    /**
     * @param $value
     * @param array $constraints
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function validate($value, array $constraints)
    {
        return $this->validator->getValidator()->validate($value, $constraints = null);
    }

    /**
     * @param $str
     * @return $this
     */
    public function addMethodMapping($str)
    {
        return $this->validator->addMethodMapping($str);
    }

}