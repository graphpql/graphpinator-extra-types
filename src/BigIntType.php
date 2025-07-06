<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

final class BigIntType extends ScalarType
{
    protected const NAME = 'BigInt';
    protected const DESCRIPTION = 'BigInt addon type (' . \PHP_INT_SIZE * 8 . ' bit)';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_int($rawValue);
    }
}
