<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;
use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\ValueObject\Numeric\Percent;

class ValidateTenderServiceTest extends TestCase
{
    /**
     * @param Tender                  $tender
     * @param StudyValueObject        $study
     * @param Tender\GraduationResult $mandatoryGraduationResult
     * @param Tender\GraduationResult $optionalGraduationResultService
     *
     * @dataProvider providerForTestSuccessValidate
     *
     * @throws NotAcceptableTenderException
     */
    public function testSuccessValidate(
        Tender $tender,
        StudyValueObject $study,
        Tender\GraduationResult $mandatoryGraduationResult,
        Tender\GraduationResult $optionalGraduationResultService
    )
    {
        $getMandatoryGraduationResultService = $this->getMockBuilder(GetMandatoryGraduationResultService::class)->getMock();
        $getMandatoryGraduationResultService
            ->expects($this->once())
            ->method('get')
            ->with($tender, $study)
            ->willReturn($mandatoryGraduationResult);

        $getBestOptionalGraduationResultService = $this->getMockBuilder(GetBestOptionalGraduationResultService::class)->getMock();
        $getBestOptionalGraduationResultService
            ->expects($this->once())
            ->method('get')
            ->with($tender, $study)
            ->willReturn($optionalGraduationResultService);

        $validateTenderService = new ValidateTenderService(
            $getBestOptionalGraduationResultService,
            $getMandatoryGraduationResultService
        );

        $validateTenderService->validate($tender, $study);
    }

    /**
     * @param Tender                  $tender
     * @param StudyValueObject        $study
     * @param Tender\GraduationResult $mandatoryGraduationResult
     * @param Tender\GraduationResult $optionalGraduationResultService
     *
     * @dataProvider providerForTestUnsuccessValidate
     *
     * @throws NotAcceptableTenderException
     */
    public function testUnsuccessValidate(
        Tender $tender,
        StudyValueObject $study,
        Tender\GraduationResult $mandatoryGraduationResult,
        Tender\GraduationResult $optionalGraduationResultService
    )
    {
        $getMandatoryGraduationResultService = $this->getMockBuilder(GetMandatoryGraduationResultService::class)->getMock();
        $getMandatoryGraduationResultService
            ->method('get')
            ->with($tender, $study)
            ->willReturn($mandatoryGraduationResult);

        $getBestOptionalGraduationResultService = $this->getMockBuilder(GetBestOptionalGraduationResultService::class)->getMock();
        $getBestOptionalGraduationResultService
            ->method('get')
            ->with($tender, $study)
            ->willReturn($optionalGraduationResultService);

        $validateTenderService = new ValidateTenderService(
            $getBestOptionalGraduationResultService,
            $getMandatoryGraduationResultService
        );

        $this->expectException(NotAcceptableTenderException::class);

        $validateTenderService->validate($tender, $study);
    }

    public static function providerForTestSuccessValidate()
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
                            new Percent(70),
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

                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(90),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
        ];
    }

    public static function providerForTestUnsuccessValidate()
    {
        return [
            'no_required_final_exam' => [
                'tender' => new Tender(
                    new Tender\TenderStudy(
                        new University(University::ELTE),
                        new Faculty(Faculty::IK),
                        new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
                    ),
                    new GraduationResultCollection([
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
                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(10),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
            'low_result_mandatory_final_exam' => [
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
                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(10),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
            'low_result_mandatory_subject' => [
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
                            new Percent(60),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::TORTENELEM),
                            new Level (Level::INTERMEDIATE),
                            new Percent(80),
                        ),
                        new Tender\GraduationResult(
                            new Subject(Subject::MATEMATKA),
                            new Level(Level::INTERMEDIATE),
                            new Percent(10),
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
                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(10),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
            'no_optional_subject' => [
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
                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(90),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::KEMIA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(95),
                ),
            ],
            'low_result_optional_subject' => [
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
                            new Percent(10),
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
                'study' => self::getStudyForProvider(),
                'mandatoryGraduationResult' => new Tender\GraduationResult(
                    new Subject(Subject::MATEMATKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(90),
                ),
                'optionalGraduationResultService' => new Tender\GraduationResult(
                    new Subject(Subject::INFORMATIKA),
                    new Level(Level::INTERMEDIATE),
                    new Percent(10),
                ),
            ],
        ];
    }

    private static function getStudyForProvider(): StudyValueObject
    {
        return new StudyValueObject(
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
        );
    }
}