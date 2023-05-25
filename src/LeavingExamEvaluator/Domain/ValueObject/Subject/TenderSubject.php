<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;

class TenderSubject
{
    /**
     * @param Subject         $subject
     * @param LevelCollection $levelCollection
     */
    public function __construct(private readonly Subject $subject, private readonly LevelCollection $levelCollection)
    {
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @return LevelCollection
     */
    public function getLevelCollection(): LevelCollection
    {
        return $this->levelCollection;
    }
}
