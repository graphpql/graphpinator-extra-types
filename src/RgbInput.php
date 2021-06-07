<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

class RgbInput extends \Graphpinator\Typesystem\InputType
{
    protected const NAME = 'RgbInput';
    protected const DESCRIPTION = 'Rgb input - input for the RGB color model.';

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
                'red',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'green',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'blue',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
        ]);
    }
}
