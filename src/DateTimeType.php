<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class DateTimeType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'DateTime';
    protected const DESCRIPTION = 'DateTime type - string which contains valid date in ISO8601 format.';

    public function __construct()
    {
        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');

        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (\Nette\Utils\DateTime::createFromFormat(\DateTimeInterface::ATOM, $rawValue) instanceof \Nette\Utils\DateTime);
    }
}
