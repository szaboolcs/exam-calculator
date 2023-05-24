<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\GraduationResult;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\TenderStudy;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\Exception\InvalidEnumValueException;
use School\Scalar\ValueObject\Numeric\Percent;

class TenderStudyTest extends TestCase
{
    /**
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(
        TenderStudy $tenderStudy,
        University $university,
        Faculty $faculty,
        Study $study,
    ) {
        $this->assertSame($university, $tenderStudy->getUniversity());
        $this->assertSame($faculty, $tenderStudy->getFaculty());
        $this->assertSame($study, $tenderStudy->getStudy());
    }

    public static function providerForTestConstruction()
    {
        $university  = new University(University::ELTE);
        $faculty     = new Faculty(Faculty::IK);
        $study       = new Study(Study::PROGRAMTERVEZO_INFORMATIKUS);
        $tenderStudy = new TenderStudy($university, $faculty, $study);

        return [
            [
                'tenderStudy' => $tenderStudy,
                'university'  => $university,
                'faculty'     => $faculty,
                'study'       => $study,
            ],
        ];
    }
}
