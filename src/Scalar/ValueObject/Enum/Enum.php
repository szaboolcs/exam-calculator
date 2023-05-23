<?php

namespace School\Scalar\ValueObject\Enum;

use School\Scalar\Exception\InvalidEnumValueException;
use School\Scalar\ValueObject\ValueObjectAbstract;

class Enum extends ValueObjectAbstract
{
    /**
     * @var array
     */
    protected static $enabledValues = [];

    /**
     * Enum constructor.
     *
     * @param string $value
     *
     * @throws InvalidEnumValueException
     */
    public function __construct(string $value)
    {
        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidEnumValueException
     */
    public static function validate($value)
    {
        if (!in_array($value, static::$enabledValues, true)) {
            throw new InvalidEnumValueException('Invalid ' . static::getClassName());
        }
    }
}
