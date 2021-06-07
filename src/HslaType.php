<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class HslaType extends \Graphpinator\ExtraTypes\HslType
{
    protected const NAME = 'Hsla';
    protected const DESCRIPTION = 'Hsla type - type representing the HSL color model with added alpha (transparency).';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return parent::validateNonNullValue($rawValue)
            && \property_exists($rawValue, 'alpha')
            && \is_float($rawValue->alpha);
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
    {
        return parent::getFieldDefinition()->merge(
            new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
                \Graphpinator\Typesystem\Field\ResolvableField::create(
                    'alpha',
                    \Graphpinator\Typesystem\Container::Float()->notNull(),
                    static function (\stdClass $hsla) : float {
                        return $hsla->alpha;
                    },
                )->addDirective(
                    $this->constraintDirectiveAccessor->getFloat(),
                    ['min' => 0.0, 'max' => 1.0],
                ),
            ]),
        );
    }
}
