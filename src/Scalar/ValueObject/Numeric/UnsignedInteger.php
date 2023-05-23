<?php

namespace School\Scalar\ValueObject\Numeric;

use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\ValueObjectAbstract;

class UnsignedInteger extends ValueObjectAbstract
{
    /**
     * Lower limit.
     *
     * @var int
     */
    public const LIMIT_LOWER = 0;

    /**
     * Upper limit.
     *
     * @var int
     */
    public const LIMIT_UPPER = PHP_INT_MAX;

    /**
     * @param int $value
     *
     * @throws IntegerOutOfRangeException
     */
    public function __construct(int $value)
    {
        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param $value
     *
     * @throws IntegerOutOfRangeException
     */
    public static function validate($value)
    {
        if ($value < static::LIMIT_LOWER || $value > static::LIMIT_UPPER) {
            throw new IntegerOutOfRangeException(
                'Integer is out of range [value: ' . $value . ', valid range: ' . static::LIMIT_LOWER
                . ' - ' . static::LIMIT_UPPER . ']'
            );
        }
    }
}
