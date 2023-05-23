<?php

namespace School\Scalar\ValueObject\Enum;

use School\Scalar\Exception\InvalidEnumValueException;
use PHPUnit\Framework\TestCase;

class TestEnumObject extends Enum
{
    /**
     * @var string[]
     */
    protected static $enabledValues = [
        'test',
    ];
}

class EnumTest extends TestCase
{
    /**
     * @throws InvalidEnumValueException
     */
    public function testConstruction()
    {
        $value = 'test';

        $testEnumObject = new TestEnumObject($value);

        $this->assertEquals($value, $testEnumObject->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new TestEnumObject($value);
    }
}
