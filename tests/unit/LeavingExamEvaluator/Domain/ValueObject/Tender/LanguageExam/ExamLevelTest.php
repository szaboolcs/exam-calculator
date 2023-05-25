<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use PHPUnit\Framework\TestCase;

class ExamLevelTest extends TestCase
{
    public function testConstruction()
    {
        $subject = new ExamLevel(ExamLevel::C1);

        $this->assertEquals(ExamLevel::C1, $subject->getValue());
    }

    /**
     * @dataProvider providerForTestCompare
     */
    public function testCompare($examLevel, $comparableExamLevel, $expected)
    {
        $this->assertEquals($expected, $examLevel->compare($comparableExamLevel));
    }

    /**
     * @return array[]
     */
    public static function providerForTestCompare(): array
    {
        return [
            [
                'examLevel'           => new ExamLevel(ExamLevel::C1),
                'comparableExamLevel' => new ExamLevel(ExamLevel::C1),
                'expected'            => 0
            ],
            [
                'examLevel'           => new ExamLevel(ExamLevel::B2),
                'comparableExamLevel' => new ExamLevel(ExamLevel::C1),
                'expected'            => 1
            ],
            [
                'examLevel'           => new ExamLevel(ExamLevel::C1),
                'comparableExamLevel' => new ExamLevel(ExamLevel::B2),
                'expected'            => -1
            ],
        ];

    }
}
