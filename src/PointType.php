<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

final class PointType extends Type
{
    protected const NAME = 'Point';
    protected const DESCRIPTION = 'Point type - x and y coordinates.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return $rawValue instanceof \stdClass
            && \property_exists($rawValue, 'x')
            && \property_exists($rawValue, 'y')
            && \is_float($rawValue->x)
            && \is_float($rawValue->y);
    }

    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            new ResolvableField(
                'x',
                Container::Float()->notNull(),
                static function(\stdClass $point) : float {
                    return $point->x;
                },
            ),
            new ResolvableField(
                'y',
                Container::Float()->notNull(),
                static function(\stdClass $point) : float {
                    return $point->y;
                },
            ),
        ]);
    }
}
