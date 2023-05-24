<?php

namespace unit\Scalar\ValueObject\Numeric;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\Percent;

class PercentTest extends TestCase
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
        $unsignedInteger = new Percent($value);

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
        new Percent($value);
    }

    /**
     * @return array
     */
    public static function providerForTestConstruction(): array
    {
        return [
            '12%' => [12],
            '0%' => [0],
            '100%' => [100],
        ];
    }

    /**
     * @return array
     */
    public static function providerForTestConstructionForIntegerOutOfRange(): array
    {
        return [
            '-1%' => [-1],
            '101%' => [101],
        ];
    }
}
