<?php

namespace LeavingExamEvaluator\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\ExamLevel;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\Language;

class LanguageExamTest extends TestCase
{
    /**
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(
        LanguageExam $languageExam,
        Language $language,
        ExamLevel $examLevel,
    ) {
        $this->assertSame($language, $languageExam->getLanguage());
        $this->assertSame($examLevel, $languageExam->getLevel());
    }

    public static function providerForTestConstruction()
    {
        $language     = new Language(Language::ANGOL);
        $examLevel    = new ExamLevel(ExamLevel::C1);
        $languageExam = new LanguageExam($language, $examLevel);

        return [
            [
                'languageExam' => $languageExam,
                'language'     => $language,
                'examLevel'    => $examLevel,
            ],
        ];
    }
}
