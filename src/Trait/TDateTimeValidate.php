<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Trait;

trait TDateTimeValidate
{
    private function isValid(string $value, string $format) : bool
    {
        $dateTime = \DateTimeImmutable::createFromFormat($format, $value);
        $errors = \DateTimeImmutable::getLastErrors();

        return $dateTime instanceof \DateTimeImmutable
            && ($errors === false || ($errors['error_count'] === 0 && $errors['warning_count'] === 0));
    }
}
