<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

final class MacType extends ScalarType
{
    protected const NAME = 'Mac';
    protected const DESCRIPTION = 'Mac type - string which contains valid MAC (media access control) address.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (bool) \filter_var($rawValue, \FILTER_VALIDATE_MAC);
    }
}
