<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\Exception\InvalidCollectionItemException;

class LanguageExamCollectionTest extends TestCase
{
    /**
     * @param LanguageExamCollection $collection
     * @param array                  $expected
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(LanguageExamCollection $collection, array $expected)
    {
        $this->assertSame($expected, $collection->toArray());
    }

    /**
     * @return array[]
     *
     * @throws IntegerOutOfRangeException
     * @throws InvalidCollectionItemException
     */
    public static function providerForTestConstruction(): array
    {
        $array                  = [
            new LanguageExam(
                new LanguageExam\Language(LanguageExam\Language::ANGOL),
                new LanguageExam\ExamLevel(LanguageExam\ExamLevel::C1),
            )
        ];
        $languageExamCollection = new LanguageExamCollection($array);

        return [
            [
                'collection'    => $languageExamCollection,
                'expectedArray' => $array,
            ]
        ];
    }
}
