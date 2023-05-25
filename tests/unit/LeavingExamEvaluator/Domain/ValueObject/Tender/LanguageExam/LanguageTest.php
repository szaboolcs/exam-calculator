<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function testConstruction()
    {
        $subject = new Language(Language::ANGOL);

        $this->assertEquals(Language::ANGOL, $subject->getValue());
    }
}
