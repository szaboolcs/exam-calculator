<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\Scalar\ValueObject\Enum\Enum;

class Subject extends Enum
{
    const MAGYAR_NYELV_ES_IRODALOM ='magyar_nyelv_es_irodalom';
    const MATEMATKA = 'matematika';
    const BIOLOGIA = 'biologia';
    const FIZIKA = 'fizika';
    const INFORMATIKA = 'informatika';
    const KEMIA = 'kemia';
    const ANGOL = 'angol';
    const FRANCIA = 'francia';
    const NEMET = 'nemet';
    const OLASZ = 'olasz';
    const SPANYOL = 'spanyol';
    const OROSZ = 'orosz';
    const TORTENELEM = 'tortenelem';

    protected static $enabledValues = [
        self::MAGYAR_NYELV_ES_IRODALOM,
        self::MATEMATKA,
        self::BIOLOGIA,
        self::FIZIKA,
        self::INFORMATIKA,
        self::KEMIA,
        self::ANGOL,
        self::FRANCIA,
        self::NEMET,
        self::OLASZ,
        self::SPANYOL,
        self::OROSZ,
        self::TORTENELEM,
    ];
}
