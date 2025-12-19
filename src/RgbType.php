<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

class RgbType extends Type
{
    protected const NAME = 'Rgb';
    protected const DESCRIPTION = 'Rgb type - type representing the RGB color model.';

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
            && \property_exists($rawValue, 'red')
            && \property_exists($rawValue, 'green')
            && \property_exists($rawValue, 'blue')
            && \is_int($rawValue->red)
            && \is_int($rawValue->green)
            && \is_int($rawValue->blue);
    }

    #[\Override]
    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                'red',
                Container::Int()->notNull(),
                static function (\stdClass $rgb) : int {
                    return $rgb->red;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            ResolvableField::create(
                'green',
                Container::Int()->notNull(),
                static function (\stdClass $rgb) : int {
                    return $rgb->green;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0, 'max' => 255],
            ),
            ResolvableField::create(
                'blue',
                Container::Int()->notNull(),
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
