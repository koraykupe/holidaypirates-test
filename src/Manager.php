<?php
namespace JobBoard;

use JobBoard\Traits\CanModerate;

class Manager extends User
{
    use CanModerate;
}