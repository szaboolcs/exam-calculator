<?php

namespace unit\Scalar\ValueObject\String;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\InvalidStringException;
use School\Scalar\ValueObject\String\StringLiteral;

class StringLiteralTest extends TestCase
{
    /**
     * @param string $value
     *
     * @throws InvalidStringException
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(string $value)
    {
        $stringLiteral = new StringLiteral($value);

        $this->assertEquals($value, $stringLiteral->getValue());
    }

    /**
     * @param mixed $value
     *
     * @dataProvider providerForTestConstructionForInvalidString
     */
    public function testConstructionForInvalidString($value)
    {
        $this->expectException(InvalidStringException::class);
        StringLiteral::validate($value);
    }

    public function testToString()
    {
        $stringLiteral = new StringLiteral('test');

        $this->assertEquals('test', "$stringLiteral");
    }

    /**
     * @return array
     */
    public static function providerForTestConstruction(): array
    {
        return [
            'empty string' => [''],
            'test' => ['test'],
            '1234' => ['1234'],
        ];
    }

    /**
     * @return array
     */
    public static function providerForTestConstructionForInvalidString(): array
    {
        return [
            'integer' => [1],
            'float' => [1.2],
            'array' => [[]],
        ];
    }
}
