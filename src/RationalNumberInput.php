<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;

final class RationalNumberInput extends InputType
{
    protected const NAME = 'RationalNumberInput';
    protected const DESCRIPTION = 'RationalNumber input - input for the RationalNumber structure.';

    public function __construct(
        private ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    #[\Override]
    protected function getFieldDefinition() : ArgumentSet
    {
        return new ArgumentSet([
            Argument::create(
                'numerator',
                Container::Int()->notNull(),
            ),
            Argument::create(
                'denominator',
                Container::Int()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 1],
            ),
        ]);
    }
}
