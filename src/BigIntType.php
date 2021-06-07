<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class BigIntType extends \Graphpinator\Typesystem\ScalarType
{
    protected const NAME = 'BigInt';
    protected const DESCRIPTION = 'BigInt addon type (' . \PHP_INT_SIZE * 8 . ' bit)';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_int($rawValue);
    }
}
