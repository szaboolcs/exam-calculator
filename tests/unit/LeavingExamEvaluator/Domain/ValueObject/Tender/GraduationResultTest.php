<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;


use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\Scalar\ValueObject\Numeric\Percent;

class GraduationResultTest extends TestCase
{
    /**
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(
        GraduationResult $graduationResult,
        Subject $subject,
        Level $level,
        Percent $result,
    ) {
        $this->assertSame($subject, $graduationResult->getSubject());
        $this->assertSame($level, $graduationResult->getLevel());
        $this->assertSame($result, $graduationResult->getResult());
    }

    public static function providerForTestConstruction()
    {
        $subject          = new Subject(Subject::TORTENELEM);
        $level            = new Level(Level::ADVANCED);
        $result           = new Percent(70);
        $graduationResult = new GraduationResult($subject, $level, $result);

        return [
            [
                'graduationResult' => $graduationResult,
                'subject'          => $subject,
                'level'            => $level,
                'result'           => $result,
            ]
        ];
    }
}
