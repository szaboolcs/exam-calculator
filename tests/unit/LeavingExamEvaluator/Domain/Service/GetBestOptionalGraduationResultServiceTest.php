<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;
use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\Exception\InvalidCollectionItemException;
use School\Scalar\ValueObject\Numeric\Percent;
use School\LeavingExamEvaluator\Domain\ValueObject\Study as StudyValueObject;

class GetBestOptionalGraduationResultServiceTest extends TestCase
{
    /**
     * @param Tender $tender
     * @param StudyValueObject $study
     * @param Tender\GraduationResult $optionalGraduationResultService
     *
     * @dataProvider providerForTestGet
     */
    public function testGet(
        Tender $tender,
        StudyValueObject $study,
        Tender\GraduationResult $optionalGraduationResultService,
    ) {
        $getBestOptionalGraduationResultService = new GetBestOptionalGraduationResultService();
        $graduationResult                       = $getBestOptionalGraduationResultService->get($tender, $study);

        $this->assertEquals($optionalGraduationResultService, $graduationResult);
    }

    /**
     * @return array[]
     * @throws IntegerOutOfRangeException
     * @throws InvalidCollectionItemException
     */
    public static function providerForTestGet(): array
    {
        return [
            [
                'tender' => new Tender(
                    new Tender\TenderStudy(
                        new University(University::ELTE),
                        new Faculty(Faculty::IK),
                        new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
                    ),
                    new GraduationResultCollection([
                        new Tender\GraduationResult(
                            new Subject(Subject::MAGYAR_NYELV_ES_IRODALOM),
                            new Level(Level::INTERMEDIATE),
                            new Percent(15),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::TORTENELEM),
                            new Level (Level::INTERMEDIATE),
                            new Percent(80),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::MATEMATKA),
                            new Level(Level::INTERMEDIATE),
                            new Percent(90),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::ANGOL),
                            new Level(Level::INTERMEDIATE),
                            new Percent(94),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::INFORMATIKA),
                            new Level(Level::INTERMEDIATE),
                            new Percent(95),
                        ),
                    ]),
                    new LanguageExamCollection([
                        new Tender\LanguageExam(
                            new Tender\LanguageExam\Language(Tender\LanguageExam\Language::ANGOL),
                            new Tender\LanguageExam\ExamLevel(Tender\LanguageExam\ExamLevel::B2)
                        ),
                        new Tender\LanguageExam(
                            new Tender\LanguageExam\Language(Tender\LanguageExam\Language::NEMET),
                            new Tender\LanguageExam\ExamLevel(Tender\LanguageExam\ExamLevel::C1)
                        ),
                    ]),
                ),
                'study' => new StudyValueObject(
                    new University(University::ELTE),
                    new Faculty(Faculty::IK),
                    new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
                    new TenderSubject(
                        new Subject(Subject::MATEMATKA),
                        new LevelCollection([
                            new Level(Level::INTERMEDIATE),
                            new Level(Level::ADVANCED),
                        ]),
                    ),
                    new TenderSubjectCollection([
                        new TenderSubject(
                            new Subject(Subject::BIOLOGIA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::FIZIKA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::INFORMATIKA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::KEMIA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                    ])
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
        ];
    }
}
