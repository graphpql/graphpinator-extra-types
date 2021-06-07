<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class RgbaInput extends \Graphpinator\ExtraTypes\RgbInput
{
    protected const NAME = 'RgbaInput';
    protected const DESCRIPTION = 'Rgb input - input for the RGB color model with added alpha (transparency).';

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return parent::getFieldDefinition()->merge(
            new \Graphpinator\Typesystem\Argument\ArgumentSet([
                \Graphpinator\Typesystem\Argument\Argument::create(
                    'alpha',
                    \Graphpinator\Typesystem\Container::Float()->notNull(),
                )->addDirective(
                    $this->constraintDirectiveAccessor->getFloat(),
                    ['min' => 0.0, 'max' => 1.0],
                ),
            ]),
        );
    }
}
