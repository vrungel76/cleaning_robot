<?php

namespace app\Decorator;

class Decorator
{
    /**
     * @var object
     */
    protected $entity;

    /**
     * @param object|array $entity
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($entity)
    {
        if (! is_array($entity) && ! is_object($entity)) {
            throw new \InvalidArgumentException('Argument "$entity" must be an array or an object.');
        }
        $this->entity = $entity;
    }
}