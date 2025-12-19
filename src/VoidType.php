<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<null>
 */
#[Description('Void type - placeholder type if null only is used.')]
final class VoidType extends ScalarType
{
    protected const NAME = 'Void';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : null
    {
        return null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : never
    {
        throw new \LogicException('Void type cannot be outputted.');
    }
}
