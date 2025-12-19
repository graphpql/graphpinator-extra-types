<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;

class RgbInput extends InputType
{
    protected const NAME = 'RgbInput';
    protected const DESCRIPTION = 'Rgb input - input for the RGB color model.';

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
                'red',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            Argument::create(
                'green',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            Argument::create(
                'blue',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
        ]);
    }
}
