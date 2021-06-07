<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class PointInput extends \Graphpinator\Typesystem\InputType
{
    protected const NAME = 'PointInput';
    protected const DESCRIPTION = 'Point input - input for the Point.';

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return new \Graphpinator\Typesystem\Argument\ArgumentSet([
            new \Graphpinator\Typesystem\Argument\Argument(
                'x',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
            ),
            new \Graphpinator\Typesystem\Argument\Argument(
                'y',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
            ),
        ]);
    }
}
