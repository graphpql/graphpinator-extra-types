<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

class HslInput extends \Graphpinator\Typesystem\InputType
{
    protected const NAME = 'HslInput';
    protected const DESCRIPTION = 'Hsl input - input for the HSL color model.';

    public function __construct(
        protected \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return new \Graphpinator\Typesystem\Argument\ArgumentSet([
            \Graphpinator\Typesystem\Argument\Argument::create(
                'hue',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 360],
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'saturation',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'lightness',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
        ]);
    }
}
