<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

final class PostalCodeType extends ScalarType
{
    protected const NAME = 'PostalCode';
    protected const DESCRIPTION = 'PostalCode type - string which contains valid postal code (ZIP code) in "NNN NN" format.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \preg_match('/^[0-9]{3}\s[0-9]{2}$/', $rawValue) === 1;
    }
}
