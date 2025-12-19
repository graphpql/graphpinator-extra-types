<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

class HslType extends Type
{
    protected const NAME = 'Hsl';
    protected const DESCRIPTION = 'Hsl type - type representing the HSL color model.';

    public function __construct(
        protected ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    #[\Override]
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

    #[\Override]
    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                'hue',
                Container::Int()->notNull(),
                static function (\stdClass $hsl) : int {
                    return $hsl->hue;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 360],
            ),
            ResolvableField::create(
                'saturation',
                Container::Int()->notNull(),
                static function (\stdClass $hsl) : int {
                    return $hsl->saturation;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 100],
            ),
            ResolvableField::create(
                'lightness',
                Container::Int()->notNull(),
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
