<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject\Contract;

interface SubjectHumanInterface
{
    /**
     * @var string
     */
    public const MAGYAR_NYELV_ES_IRODALOM = 'magyar_nyelv_es_irodalom';

    /**
     * @var string
     */
    public const TORTENELEM = 'tortenelem';

    /**
     * @var string
     */
    public const ANGOL = 'angol';

    /**
     * @var string
     */
    public const FRANCIA = 'francia';

    /**
     * @var string
     */
    public const NEMET = 'nemet';

    /**
     * @var string
     */
    public const OLASZ = 'olasz';

    /**
     * @var string
     */
    public const SPANYOL = 'spanyol';

    /**
     * @var string
     */
    public const OROSZ = 'orosz';
}
