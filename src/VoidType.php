<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class VoidType extends \Graphpinator\Type\Scalar\ScalarType
{
    protected const NAME = 'Void';
    protected const DESCRIPTION = 'Void type - accepts null only.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return false;
    }
}
