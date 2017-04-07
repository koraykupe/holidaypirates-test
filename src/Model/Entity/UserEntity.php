<?php

namespace JobBoard\Model\Entity;

use Spot\Entity as SpotEntity;

/**
 * Class UserEntity
 * @package JobBoard\Model\Entity
 */
class UserEntity extends SpotEntity
{
    /**
     * @var string
     */
    protected static $table = 'users';

    /**
     * @return array
     */
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