<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\GraduationResult;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\ExamLevel;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\Language;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\TenderStudy;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\ValueObject\Numeric\Percent;

class TenderTest extends TestCase
{
    /**
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(
        Tender $tender,
        TenderStudy $tenderStudy,
        GraduationResultCollection $graduationResultCollection,
        LanguageExamCollection $languageExamCollection,
    ) {
        $this->assertSame($tenderStudy, $tender->getTenderStudy());
        $this->assertSame($graduationResultCollection, $tender->getGraduationResultCollection());
        $this->assertSame($languageExamCollection, $tender->getLanguageExamCollection());
    }

    public static function providerForTestConstruction()
    {
        $university  = new University(University::ELTE);
        $faculty     = new Faculty(Faculty::IK);
        $study       = new Study(Study::PROGRAMTERVEZO_INFORMATIKUS);
        $tenderStudy = new TenderStudy($university, $faculty, $study);

        $subject          = new Subject(Subject::TORTENELEM);
        $level            = new Level(Level::ADVANCED);
        $percent          = new Percent(70);
        $graduationResult = new GraduationResult($subject, $level, $percent);

        $graduationResultCollection = new GraduationResultCollection();
        $graduationResultCollection->add($graduationResult);

        $language     = new Language(Language::ANGOL);
        $examLevel    = new ExamLevel(ExamLevel::B2);
        $languageExam = new Tender\LanguageExam($language, $examLevel);

        $languageExamCollection = new LanguageExamCollection();
        $languageExamCollection->add($languageExam);

        $tender = new Tender($tenderStudy, $graduationResultCollection, $languageExamCollection);

        return [
            [
                'tender'                     => $tender,
                'tenderStudy'                => $tenderStudy,
                'graduationResultCollection' => $graduationResultCollection,
                'languageExamCollection'     => $languageExamCollection,
            ]
        ];
    }
}
