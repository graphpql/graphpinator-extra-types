<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;

#[Description('Date type - string which contains valid date in "<YYYY>-<MM>-<DD>" format.')]
final class DateType extends BaseDateType
{
    protected const NAME = 'Date';

    public function __construct()
    {
        parent::__construct('Y-m-d');

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?\DateTimeImmutable
    {
        $date = parent::validateAndCoerceInput($rawValue);

        return $date instanceof \DateTimeImmutable
            ? $date->setTime(0, 0)
            : null;
    }
}
