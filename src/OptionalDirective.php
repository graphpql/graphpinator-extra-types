<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Exception\GraphpinatorBase;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Directive;
use Graphpinator\Typesystem\Location\ArgumentDefinitionLocation;
use Graphpinator\Value\ArgumentValue;
use Graphpinator\Value\ArgumentValueSet;
use Graphpinator\Value\NullInputedValue;

final class OptionalDirective extends Directive implements
    ArgumentDefinitionLocation
{
    protected const NAME = 'optional';
    protected const DESCRIPTION = 'Input value for this argument can be either omitted or have non-null value.';

    public static function isPure() : bool
    {
        return true;
    }

    public function validateArgumentUsage(
        Argument $argument,
        ArgumentValueSet $arguments,
    ) : bool
    {
        return true;
    }

    public function validateVariance(
        ?ArgumentValueSet $biggerSet,
        ?ArgumentValueSet $smallerSet,
    ) : void
    {
        if ($biggerSet instanceof ArgumentValueSet &&
            $smallerSet instanceof ArgumentValueSet &&
            $biggerSet->isSame($smallerSet)) {
            return;
        }

        throw new \Exception();
    }

    public function resolveArgumentDefinition(
        ArgumentValueSet $arguments,
        ArgumentValue $argumentValue,
    ) : void
    {
        if ($argumentValue->getValue() instanceof NullInputedValue) {
            throw new class extends GraphpinatorBase {
                public const MESSAGE = 'Input field is @optional and therefore cannot contain null value.';

                public function isOutputable() : bool
                {
                    return true;
                }
            };
        }
    }

    protected function getFieldDefinition() : ArgumentSet
    {
        return new ArgumentSet();
    }
}
