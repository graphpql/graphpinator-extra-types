<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class AnyType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Any';
    protected const DESCRIPTION = 'Any addon type, accepts any scalar type - String, Int, Float or Bool.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_scalar($rawValue);
    }
}
