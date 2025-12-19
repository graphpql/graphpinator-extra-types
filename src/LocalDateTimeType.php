<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;

#[Description('LocalDateTime type - string which contains valid date in "YYYY-MM-DD HH:MM:SS" format (without timezone information).')]
final class LocalDateTimeType extends BaseDateType
{
    protected const NAME = 'LocalDateTime';

    public function __construct()
    {
        parent::__construct('Y-m-d H:i:s');
    }
}
