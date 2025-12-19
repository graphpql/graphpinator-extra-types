<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;

#[Description('DateTimeMs type - string which contains valid date in ISO8601 format.')]
final class DateTimeMsType extends BaseDateType
{
    protected const NAME = 'DateTimeMs';

    public function __construct()
    {
        parent::__construct(\DateTimeInterface::RFC3339_EXTENDED);

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }
}
