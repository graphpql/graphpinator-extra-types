<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;

#[Description('DateTime type - string which contains valid date in ISO8601 format without miliseconds.')]
final class DateTimeType extends BaseDateType
{
    protected const NAME = 'DateTime';

    public function __construct()
    {
        parent::__construct(\DateTimeInterface::ATOM);

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }
}
