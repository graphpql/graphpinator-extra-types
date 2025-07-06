<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ExtraTypes\Trait\TDateTimeValidate;
use Graphpinator\Typesystem\ScalarType;

final class LocalTimeEndType extends ScalarType
{
    use TDateTimeValidate;

    protected const NAME = 'LocalTimeEnd';
    protected const DESCRIPTION = 'LocalTimeEnd type - string which contains time in "HH:MM:SS" format (without timezone information), including a special 24:00:00 value for usage in intervals.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && ($rawValue === '24:00:00' || $this->isValid($rawValue, 'H:i:s'));
    }
}
