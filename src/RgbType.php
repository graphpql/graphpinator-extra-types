<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

class RgbType extends \Graphpinator\Typesystem\Type
{
    protected const NAME = 'Rgb';
    protected const DESCRIPTION = 'Rgb type - type representing the RGB color model.';

    public function __construct(
        protected \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return $rawValue instanceof \stdClass
            && \property_exists($rawValue, 'red')
            && \property_exists($rawValue, 'green')
            && \property_exists($rawValue, 'blue')
            && \is_int($rawValue->red)
            && \is_int($rawValue->green)
            && \is_int($rawValue->blue);
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
    {
        return new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'red',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $rgb) : int {
                    return $rgb->red;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'green',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $rgb) : int {
                    return $rgb->green;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'blue',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function (\stdClass $rgb) : int {
                    return $rgb->blue;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
        ]);
    }
}
