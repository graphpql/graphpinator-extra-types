<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class PostalCodeType extends \Graphpinator\Typesystem\ScalarType
{
    protected const NAME = 'PostalCode';
    protected const DESCRIPTION = 'PostalCode type - string which contains valid postal code (ZIP code) in "NNN NN" format.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \preg_match('/^[0-9]{3}\s[0-9]{2}$/', $rawValue) === 1;
    }
}
