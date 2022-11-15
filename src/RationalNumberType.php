<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class RationalNumberType extends \Graphpinator\Typesystem\Type
{
    protected const NAME = 'RationalNumberType';
    protected const DESCRIPTION = 'RationalNumber type - structure for numerator and denominator.';

    public function __construct(
        private \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $constraintDirectiveAccessor,
    )
    {
        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return $rawValue instanceof \stdClass
            && \property_exists($rawValue, 'numerator')
            && \property_exists($rawValue, 'denominator')
            && \is_int($rawValue->numerator)
            && \is_int($rawValue->denominator);
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
    {
        return new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'numerator',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function(\stdClass $number) : int {
                    return $number->numerator;
                },
            ),
            \Graphpinator\Typesystem\Field\ResolvableField::create(
                'denominator',
                \Graphpinator\Typesystem\Container::Int()->notNull(),
                static function(\stdClass $number) : int {
                    return $number->denominator;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 0],
            ),
        ]);
    }
}
