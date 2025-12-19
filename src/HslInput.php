<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;

class HslInput extends InputType
{
    protected const NAME = 'HslInput';
    protected const DESCRIPTION = 'Hsl input - input for the HSL color model.';

    public function __construct(
        protected ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    #[\Override]
    protected function getFieldDefinition() : ArgumentSet
    {
        return new ArgumentSet([
            Argument::create(
                'hue',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 360],
            ),
            Argument::create(
                'saturation',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
            Argument::create(
                'lightness',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
        ]);
    }
}
