<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class DateTimeType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'DateTime';
    protected const DESCRIPTION = 'DateTime type - string which contains valid date in ISO8601 format.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        var_dump(\DateTimeImmutable::getLastErrors());
        return \is_string($rawValue)
            && (\Nette\Utils\DateTime::createFromFormat(\DateTimeInterface::ATOM, $rawValue) instanceof \Nette\Utils\DateTime)
            && \DateTimeImmutable::getLastErrors()['error_count'] === 0
            && \DateTimeImmutable::getLastErrors()['warning_count'] === 0;
    }
}
