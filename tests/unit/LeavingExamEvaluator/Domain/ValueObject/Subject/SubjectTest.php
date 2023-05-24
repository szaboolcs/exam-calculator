<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use PHPUnit\Framework\TestCase;
use School\Scalar\ValueObject\String\StringLiteral;

class SubjectTest extends TestCase
{
    public function testConstruction()
    {
        $subject = new Subject(Subject::TORTENELEM);

        $this->assertEquals(Subject::TORTENELEM, $subject->getValue());
    }
}
