<?php

namespace JobBoard\Validation;

/**
 * Interface Validator
 * @package JobBoard\Validation
 */
interface Validator
{
    /**
     * @param $data
     * @param array $rules
     * @return mixed
     */
    public function validate($data, array $rules);
}