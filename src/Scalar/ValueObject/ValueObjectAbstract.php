<?php

namespace School\Scalar\ValueObject;

use School\Scalar\Contract\ValueObjectInterface;

abstract class ValueObjectAbstract implements ValueObjectInterface
{
    /**
     * @param mixed $value
     */
    public function __construct(protected readonly mixed $value)
    {}

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return string
     */
    protected static function getClassName(): string
    {
        $classParts = explode('\\', static::class);

        return end($classParts);
    }
}
