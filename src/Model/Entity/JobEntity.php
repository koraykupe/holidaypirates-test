<?php

namespace JobBoard\Model\Entity;

use Spot\Entity as SpotEntity;

/**
 * Class JobEntity
 * @package JobBoard\Model\Entity
 */
class JobEntity extends SpotEntity
{
    /**
     * @var string
     */
    protected static $table = 'jobs';

    /**
     * @return array
     */
    public static function fields()
    {
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'title'        => ['type' => 'string', 'required' => true],
            'description'  => ['type' => 'text', 'required' => true],
            'email'        => ['type' => 'string', 'required' => true],
            'status'       => ['type' => 'boolean', 'default' => 0, 'required' => true],
            'user_id'      => ['type' => 'integer', 'required' => true],
            'created_at'   => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

}