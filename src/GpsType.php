<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

final class GpsType extends Type
{
    protected const NAME = 'Gps';
    protected const DESCRIPTION = 'Gps type - latitude and longitude.';

    public function __construct(
        private ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    #[\Override]
    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return $rawValue instanceof \stdClass
            && \property_exists($rawValue, 'lat')
            && \property_exists($rawValue, 'lng')
            && \is_float($rawValue->lat)
            && \is_float($rawValue->lng);
    }

    #[\Override]
    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                'lat',
                Container::Float()->notNull(),
                static function(\stdClass $gps) : float {
                    return $gps->lat;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -90.0, 'max' => 90.0],
            ),
            ResolvableField::create(
                'lng',
                Container::Float()->notNull(),
                static function(\stdClass $gps) : float {
                    return $gps->lng;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getFloat(),
                ['min' => -180.0, 'max' => 180.0],
            ),
        ]);
    }
}
