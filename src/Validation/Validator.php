<?php

namespace JobBoard\Validation;

interface Validator
{
    public function validate($data, array $rules);
}