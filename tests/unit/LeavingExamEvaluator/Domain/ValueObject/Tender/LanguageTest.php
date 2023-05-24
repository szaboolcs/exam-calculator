<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\Language;
use School\Scalar\Exception\InvalidEnumValueException;

class LanguageTest extends TestCase
{
    public function testConstruction()
    {
        $language = new Language(Language::ANGOL);

        $this->assertEquals(Language::ANGOL, $language->getValue());
    }

    public function testConstructionForInvalidEnumItem()
    {
        $this->expectException(InvalidEnumValueException::class);
        $value = 'Invalid item';

        new Language($value);
    }
}
