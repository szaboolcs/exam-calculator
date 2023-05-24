<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\InvalidEnumValueException;

class TypeTest extends TestCase
{
    public function testConstruction()
    {
        $type = new Type(Type::MANDATORY);

        $this->assertEquals(Type::MANDATORY, $type->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new Type($value);
    }
}
