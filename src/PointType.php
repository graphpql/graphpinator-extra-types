<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class PointType extends \Graphpinator\Typesystem\Type
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

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
    {
        return new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
            new \Graphpinator\Typesystem\Field\ResolvableField(
                'x',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
                static function(\stdClass $point) : float {
                    return $point->x;
                },
            ),
            new \Graphpinator\Typesystem\Field\ResolvableField(
                'y',
                \Graphpinator\Typesystem\Container::Float()->notNull(),
                static function(\stdClass $point) : float {
                    return $point->y;
                },
            ),
        ]);
    }
}
