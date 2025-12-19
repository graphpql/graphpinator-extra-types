<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

final class RgbaType extends RgbType
{
    protected const NAME = 'Rgba';
    protected const DESCRIPTION = 'Rgba type - type representing the RGB color model with added alpha (transparency).';

    #[\Override]
    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return parent::validateNonNullValue($rawValue)
            && \property_exists($rawValue, 'alpha')
            && \is_float($rawValue->alpha);
    }

    #[\Override]
    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return parent::getFieldDefinition()->merge(
            new ResolvableFieldSet([
                ResolvableField::create(
                    'alpha',
                    Container::Float()->notNull(),
                    static function (\stdClass $rgba) : float {
                        return $rgba->alpha;
                    },
                )->addDirective(
                    $this->constraintDirectiveAccessor->getFloat(),
                    ['min' => 0.0, 'max' => 1.0],
                ),
            ]),
        );
    }
}
