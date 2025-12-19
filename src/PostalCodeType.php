<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('PostalCode type - string which contains valid postal code (ZIP code) in "NNN NN" format.')]
final class PostalCodeType extends ScalarType
{
    protected const NAME = 'PostalCode';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && \preg_match('/^[0-9]{3}\s[0-9]{2}$/', $rawValue) === 1 // @phpstan-ignore theCodingMachineSafe.function
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
