<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use PHPUnit\Framework\TestCase;
use School\Scalar\ValueObject\String\StringLiteral;

class SubjectTest extends TestCase
{
    public function testConstruction()
    {
        $name    = new StringLiteral('name');
        $type    = new Type(Type::MANDATORY);
        $subject = new Subject($name, $type);

        $this->assertEquals($name, $subject->getName());
        $this->assertEquals($type, $subject->getType());
    }
}
