<?php

namespace JobBoard\Model\Entity;

use Spot\Entity as SpotEntity;

class UserEntity extends SpotEntity
{
    protected static $table = 'users';
    public static function fields()
    {
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'email'        => ['type' => 'string', 'unique' => true, 'required' => true],
            'password'     => ['type' => 'string', 'required' => true],
            'is_manager'   => ['type' => 'boolean', 'default' => 0, 'required' => true],
            'created_at'   => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

}