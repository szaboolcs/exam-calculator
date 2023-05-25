<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\DataMapper;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;
use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\Contract\StudyRepositoryInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\LeavingExamEvaluator\Infrastructure\Persistence\Factory\StudyFactory;
use School\Scalar\ValueObject\Numeric\Percent;

class StudyMapperTest extends TestCase
{
    /**
     * @param Tender                $tender
     * @param array                 $data
     * @param StudyValueObject|null $expected
     *
     * @dataProvider providerForTestFindByTender
     */
    public function testFindByTender(Tender $tender, array $data, StudyValueObject|null $expected)
    {
        $studyRepository = $this->getMockBuilder(StudyRepositoryInterface::class)->getMock();
        $studyRepository
            ->expects($this->once())
            ->method('getAllStudy')
            ->willReturn($data);

        $studyFactory = $this->getMockBuilder(StudyFactory::class)->getMock();

        if ($expected) {
            $studyFactory
                ->expects($this->once())
                ->method('create')
                ->willReturn($expected);
        } else {
            $studyFactory->expects($this->never())->method('create');
        }

        $studyMapper = new StudyMapper($studyRepository, $studyFactory);
        $study       = $studyMapper->findByTender($tender);

        $this->assertSame($expected, $study);
    }

    public static function providerForTestFindByTender()
    {
        return [
            'test_study_found' => [
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
                'data' => [
                    [
                        'university' => University::ELTE,
                        'faculty' => Faculty::IK,
                        'study' => Study::PROGRAMTERVEZO_INFORMATIKUS,
                        'mandatorySubject' => [
                            'subject' => Subject::MATEMATKA,
                            'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                        ],
                        'optionalSubjects' => [
                            [
                                'subject' => Subject::BIOLOGIA,
                                'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                            ],
                            [
                                'subject' => Subject::FIZIKA,
                                'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                            ],
                            [
                                'subject' => Subject::INFORMATIKA,
                                'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                            ],
                            [
                                'subject' => Subject::KEMIA,
                                'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                            ]
                        ],
                    ]
                ],
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
            ],
            'test_study_not_found' => [
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
                'data' => [
                    [
                        [
                            'university' => University::PPKE,
                            'faculty' => Faculty::BTK,
                            'study' => Study::ANGLISZTIKA,
                            'mandatorySubject' => [
                                'subject' => Subject::ANGOL,
                                'level'   => [Level::ADVANCED],
                            ],
                            'optionalSubjects' => [
                                [
                                    'subject' => Subject::FRANCIA,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                                [
                                    'subject' => Subject::NEMET,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                                [
                                    'subject' => Subject::OLASZ,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                                [
                                    'subject' => Subject::OROSZ,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                                [
                                    'subject' => Subject::SPANYOL,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                                [
                                    'subject' => Subject::TORTENELEM,
                                    'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                                ],
                            ],
                        ],
                    ]
                ],
                'study' => null,
            ],
        ];
    }
}
