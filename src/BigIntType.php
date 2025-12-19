<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<int>
 */
#[Description('BigInt addon type (' . \PHP_INT_SIZE * 8 . ' bit)')]
final class BigIntType extends ScalarType
{
    protected const NAME = 'BigInt';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?int
    {
        return \is_int($rawValue)
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : int
    {
        return $rawValue;
    }
}
