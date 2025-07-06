<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;

final class HslaInput extends HslInput
{
    protected const NAME = 'HslaInput';
    protected const DESCRIPTION = 'Hsla input - input for the HSL color model with added alpha (transparency).';

    protected function getFieldDefinition() : ArgumentSet
    {
        return parent::getFieldDefinition()->merge(
            new ArgumentSet([
                Argument::create(
                    'alpha',
                    Container::Float()->notNull(),
                )->addDirective(
                    $this->constraintDirectiveAccessor->getFloat(),
                    ['min' => 0.0, 'max' => 1.0],
                ),
            ]),
        );
    }
}
