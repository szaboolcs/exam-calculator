<?php

namespace School\Scalar\ValueObject\Numeric;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\IntegerOutOfRangeException;

class UnsignedIntegerTest extends TestCase
{
    /**
     * @param float $value
     *
     * @throws IntegerOutOfRangeException
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(float $value)
    {
        $unsignedInteger = new UnsignedInteger($value);

        $this->assertEquals($value, $unsignedInteger->getValue());
    }

    /**
     * @param mixed $value
     *
     * @throws IntegerOutOfRangeException
     *
     * @dataProvider providerForTestConstructionForIntegerOutOfRange
     */
    public function testConstructionForIntegerOutOfRange(mixed $value)
    {
        $this->expectException(IntegerOutOfRangeException::class);
        new UnsignedInteger($value);
    }

    public static function providerForTestConstruction(): array
    {
        return [
            '12'  => [12],
            '0'   => [0],
            '100' => [100],
        ];
    }

    public static function providerForTestConstructionForIntegerOutOfRange(): array
    {
        return [
            '-1' => [-1],
        ];
    }
}
