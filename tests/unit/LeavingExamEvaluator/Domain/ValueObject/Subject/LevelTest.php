<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use PHPUnit\Framework\TestCase;

class LevelTest extends TestCase
{
    public function testConstruction()
    {
        $level = new Level(Level::ADVANCED);

        $this->assertEquals(Level::ADVANCED, $level->getValue());
    }
}
