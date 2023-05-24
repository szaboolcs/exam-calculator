<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\InvalidEnumValueException;

class FacultyTest extends TestCase
{
    public function testConstruction()
    {
        $faculty = new Faculty(Faculty::BTK);

        $this->assertEquals(Faculty::BTK, $faculty->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new Faculty($value);
    }
}
