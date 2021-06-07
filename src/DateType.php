<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class DateType extends \Graphpinator\Typesystem\ScalarType
{
    use \Graphpinator\ExtraTypes\Trait\TDateTimeValidate;

    protected const NAME = 'Date';
    protected const DESCRIPTION = 'Date type - string which contains valid date in "<YYYY>-<MM>-<DD>" format.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue) && $this->isValid($rawValue, 'Y-m-d');
    }
}
