<?php

namespace School\Scalar\ValueObject;

use School\Scalar\Contract\ValueObjectInterface;

abstract class ValueObjectAbstract implements ValueObjectInterface
{
    /**
     * @param mixed $value
     */
    public function __construct(private readonly mixed $value)
    {}

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }
}
