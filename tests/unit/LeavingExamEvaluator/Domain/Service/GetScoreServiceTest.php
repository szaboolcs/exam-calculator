<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
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
use School\Scalar\ValueObject\Numeric\UnsignedInteger;
use School\LeavingExamEvaluator\Domain\ValueObject\Study as StudyValueObject;

class GetScoreServiceTest extends TestCase
{
    /**
     * @param Tender $tender
     * @param StudyValueObject $study
     * @param UnsignedInteger $baseScore
     * @param UnsignedInteger $extraScore
     * @param UnsignedInteger $expected
     *
     * @dataProvider providerForTestGet
     *
     * @throws NotAcceptableTenderException
     * @throws IntegerOutOfRangeException
     */
    public function testGet(
        Tender $tender,
        StudyValueObject $study,
        UnsignedInteger $baseScore,
        UnsignedInteger $extraScore,
        UnsignedInteger $expected
    ) {
        $getBaseScoreService = $this->getMockBuilder(GetBaseScoreService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $getBaseScoreService
            ->expects($this->once())
            ->method('get')
            ->with($tender, $study)
            ->willReturn($baseScore);

        $getExtraScoreService = $this->getMockBuilder(GetExtraScoreService::class)->getMock();
        $getExtraScoreService
            ->expects($this->once())
            ->method('get')
            ->with($tender)
            ->willReturn($extraScore);

        $getScoreService = new GetScoreService($getBaseScoreService, $getExtraScoreService);
        $score           = $getScoreService->get($tender, $study);

        $this->assertEquals($expected, $score);
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

                'baseScore' => new UnsignedInteger(370),

                'extraScore' => new UnsignedInteger(68),

                'expected' => new UnsignedInteger(438)
            ],
        ];
    }
}
