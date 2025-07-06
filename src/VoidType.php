<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

final class VoidType extends ScalarType
{
    protected const NAME = 'Void';
    protected const DESCRIPTION = 'Void type - accepts null only.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return false;
    }
}
