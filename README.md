# Leaving Exam Evaluator

Example with the test cases:

```php
<?php

use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Application\Exception\StudyNotFoundException;
use School\LeavingExamEvaluator\Application\Service\LeavingExamEvaluatorService;
use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\GraduationResult;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\TenderStudy;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\ValueObject\Numeric\Percent;

include_once 'vendor/autoload.php';

$array = [
    new Tender(
        new TenderStudy(
            new University(University::ELTE),
            new Faculty(Faculty::IK),
            new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
        ),
        new GraduationResultCollection([
            new GraduationResult(
                new Subject(Subject::MAGYAR_NYELV_ES_IRODALOM),
                new Level(Level::INTERMEDIATE),
                new Percent(70),
            ),
            new GraduationResult(
                new Subject(Subject::TORTENELEM),
                new Level(Level::INTERMEDIATE),
                new Percent(80),
            ),
            new GraduationResult(
                new Subject(Subject::MATEMATKA),
                new Level(Level::ADVANCED),
                new Percent(90),
            ),
            new GraduationResult(
                new Subject(Subject::ANGOL),
                new Level (Level::INTERMEDIATE),
                new Percent(94),
            ),
            new GraduationResult(
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
    new Tender(
        new TenderStudy(
            new University(University::ELTE),
            new Faculty(Faculty::IK),
            new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
        ),
        new GraduationResultCollection([
            new GraduationResult(
                new Subject(Subject::MAGYAR_NYELV_ES_IRODALOM),
                new Level(Level::INTERMEDIATE),
                new Percent(70),
            ),
            new GraduationResult(
                new Subject(Subject::TORTENELEM),
                new Level(Level::INTERMEDIATE),
                new Percent(80),
            ),
            new GraduationResult(
                new Subject(Subject::MATEMATKA),
                new Level(Level::ADVANCED),
                new Percent(90),
            ),
            new GraduationResult(
                new Subject(Subject::ANGOL),
                new Level (Level::INTERMEDIATE),
                new Percent(94),
            ),
            new GraduationResult(
                new Subject(Subject::INFORMATIKA),
                new Level(Level::INTERMEDIATE),
                new Percent(95),
            ),
            new GraduationResult(
                new Subject(Subject::FIZIKA),
                new Level(Level::ADVANCED),
                new Percent(98),
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
    new Tender(
        new TenderStudy(
            new University(University::ELTE),
            new Faculty(Faculty::IK),
            new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
        ),
        new GraduationResultCollection([
            new GraduationResult(
                new Subject(Subject::MATEMATKA),
                new Level(Level::ADVANCED),
                new Percent(90),
            ),
            new GraduationResult(
                new Subject(Subject::ANGOL),
                new Level (Level::INTERMEDIATE),
                new Percent(94),
            ),
            new GraduationResult(
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
    new Tender(
        new TenderStudy(
            new University(University::ELTE),
            new Faculty(Faculty::IK),
            new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
        ),
        new GraduationResultCollection([
            new GraduationResult(
                new Subject(Subject::MAGYAR_NYELV_ES_IRODALOM),
                new Level(Level::INTERMEDIATE),
                new Percent(15),
            ),
            new GraduationResult(
                new Subject(Subject::TORTENELEM),
                new Level (Level::INTERMEDIATE),
                new Percent(80),
            ),
            new GraduationResult(
                new Subject(Subject::MATEMATKA),
                new Level(Level::INTERMEDIATE),
                new Percent(90),
            ),
            new GraduationResult(
                new Subject(Subject::ANGOL),
                new Level(Level::INTERMEDIATE),
                new Percent(94),
            ),
            new GraduationResult(
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
    )
];

$leavingExamEvaluatorService = new LeavingExamEvaluatorService();

foreach ($array as $tender) {
    try {
        $score = $leavingExamEvaluatorService->getScore($tender);

        echo $score->getValue() . PHP_EOL;
    } catch (NotAcceptableTenderException $notAcceptableTenderException) {
        echo $notAcceptableTenderException->getMessage() . PHP_EOL;
    } catch (StudyNotFoundException $studyNotFoundException) {
        echo $studyNotFoundException->getMessage() . PHP_EOL;
    } catch (\Exception $exception) {
        throw $exception;
    }
}

```