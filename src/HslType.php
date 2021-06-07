<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

class HslType extends \Graphpinator\Typesystem\Type
{
    protected const NAME = 'Hsl';
    protected const DESCRIPTION = 'Hsl type - type representing the HSL color model.';

    public function __construct(
        protected \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return $rawValue instanceof \stdClass
            && \property_exists($rawValue, 'hue')
            && \property_exists($rawValue, 'saturation')
            && \property_exists($rawValue, 'lightness')
            && \is_int($rawValue->hue)
            && \is_int($rawValue->saturation)
            && \is_int($rawValue->lightness);
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
    {
        return new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'hue',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $hsl) : int {
                    return $hsl->hue;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 360],
            ),
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'saturation',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $hsl) : int {
                    return $hsl->saturation;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'lightness',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $hsl) : int {
                    return $hsl->lightness;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
        ]);
    }
}
