<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject\Contract;

interface SubjectRealInterface
{
    /**
     * @var string
     */
    public const MATEMATKA = 'matematika';

    /**
     * @var string
     */
    public const BIOLOGIA = 'biologia';

    /**
     * @var string
     */
    public const FIZIKA = 'fizika';

    /**
     * @var string
     */
    public const INFORMATIKA = 'informatika';

    /**
     * @var string
     */
    public const KEMIA = 'kemia';
}
