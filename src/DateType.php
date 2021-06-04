<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class DateType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Date';
    protected const DESCRIPTION = 'Date type - string which contains valid date in "<YYYY>-<MM>-<DD>" format.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \Nette\Utils\DateTime::createFromFormat('Y-m-d', $rawValue) instanceof \Nette\Utils\DateTime;
    }
}
