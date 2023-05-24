<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\InvalidEnumValueException;

class StudyTest extends TestCase
{
    public function testConstruction()
    {
        $studie = new Study(Study::ANGLISZTIKA);

        $this->assertEquals(Study::ANGLISZTIKA, $studie->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new Study($value);
    }
}
