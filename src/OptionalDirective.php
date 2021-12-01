<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class OptionalDirective extends \Graphpinator\Typesystem\Directive implements
    \Graphpinator\Typesystem\Location\ArgumentDefinitionLocation
{
    protected const NAME = 'optional';
    protected const DESCRIPTION = 'Input value for this argument can be either omitted or have non-null value.';

    public static function isPure() : bool
    {
        return true;
    }

    public function validateArgumentUsage(
        \Graphpinator\Typesystem\Argument\Argument $argument,
        \Graphpinator\Value\ArgumentValueSet $arguments,
    ) : bool
    {
        return true;
    }

    public function validateVariance(
        ?\Graphpinator\Value\ArgumentValueSet $biggerSet,
        ?\Graphpinator\Value\ArgumentValueSet $smallerSet,
    ) : void
    {
        if ($biggerSet instanceof \Graphpinator\Value\ArgumentValueSet &&
            $smallerSet instanceof \Graphpinator\Value\ArgumentValueSet &&
            $biggerSet->isSame($smallerSet)) {
            return;
        }

        throw new \Exception();
    }

    public function resolveArgumentDefinition(
        \Graphpinator\Value\ArgumentValueSet $arguments,
        \Graphpinator\Value\ArgumentValue $argumentValue,
    ) : void
    {
        if ($argumentValue->getValue() instanceof \Graphpinator\Value\NullInputedValue) {
            throw new class extends \Graphpinator\Exception\GraphpinatorBase {
                public const MESSAGE = 'Input field is @optional and therefore cannot contain null value.';

                public function isOutputable(): bool
                {
                    return true;
                }
            };
        }
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return new \Graphpinator\Typesystem\Argument\ArgumentSet();
    }
}
