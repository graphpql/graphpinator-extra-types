<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;

final class GpsInput extends InputType
{
    protected const NAME = 'GpsInput';
    protected const DESCRIPTION = 'Gps input - input for the GPS.';

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
                'lat',
                Container::Float()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -90.0, 'max' => 90.0],
            ),
            Argument::create(
                'lng',
                Container::Float()->notNull(),
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -180.0, 'max' => 180.0],
            ),
        ]);
    }
}
