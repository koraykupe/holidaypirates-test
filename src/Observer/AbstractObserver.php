<?php


abstract class AbstractObserver
{
    abstract function create(AbstractSubject $subject);
}