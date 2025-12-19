<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string|int|float|bool>
 */
#[Description('Any addon type, accepts any scalar type - String, Int, Float or Bool.')]
final class AnyType extends ScalarType
{
    protected const NAME = 'Any';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : null|string|int|float|bool
    {
        return \is_scalar($rawValue)
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string|int|float|bool
    {
        return $rawValue;
    }
}
