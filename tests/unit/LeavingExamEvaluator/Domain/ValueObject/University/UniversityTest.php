<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\InvalidEnumValueException;

class UniversityTest extends TestCase
{
    public function testConstruction()
    {
        $school = new University(University::PPKE);

        $this->assertEquals(University::PPKE, $school->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new University($value);
    }
}
