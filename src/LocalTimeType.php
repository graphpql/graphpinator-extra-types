<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class LocalTimeType extends \Graphpinator\Typesystem\ScalarType
{
    use \Graphpinator\ExtraTypes\Trait\TDateTimeValidate;

    protected const NAME = 'LocalTime';
    protected const DESCRIPTION = 'LocalTime type - string which contains time in "HH:MM:SS" format (without timezone information).';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue) && $this->isValid($rawValue, 'H:i:s');
    }
}
