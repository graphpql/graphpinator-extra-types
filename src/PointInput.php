<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;

final class PointInput extends InputType
{
    protected const NAME = 'PointInput';
    protected const DESCRIPTION = 'Point input - input for the Point.';

    #[\Override]
    protected function getFieldDefinition() : ArgumentSet
    {
        return new ArgumentSet([
            new Argument(
                'x',
                Container::Float()->notNull(),
            ),
            new Argument(
                'y',
                Container::Float()->notNull(),
            ),
        ]);
    }
}
