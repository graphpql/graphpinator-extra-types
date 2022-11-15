<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class RationalNumberInput extends \Graphpinator\Typesystem\InputType
{
    protected const NAME = 'RationalNumberInput';
    protected const DESCRIPTION = 'RationalNumber input - input for the RationalNumber structure.';

    public function __construct(
        private \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return new \Graphpinator\Typesystem\Argument\ArgumentSet([
            \Graphpinator\Typesystem\Argument\Argument::create(
                'numerator',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'denominator',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 1],
            ),
        ]);
    }
}
