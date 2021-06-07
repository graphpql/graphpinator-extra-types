<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class GpsInput extends \Graphpinator\Typesystem\InputType
{
    protected const NAME = 'GpsInput';
    protected const DESCRIPTION = 'Gps input - input for the GPS.';

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
                'lat',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -90.0, 'max' => 90.0],
            ),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'lng',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -180.0, 'max' => 180.0],
            ),
        ]);
    }
}
