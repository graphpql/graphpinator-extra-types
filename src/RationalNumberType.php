<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

final class RationalNumberType extends Type
{
    protected const NAME = 'RationalNumberType';
    protected const DESCRIPTION = 'RationalNumber type - structure for numerator and denominator.';

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
            && \property_exists($rawValue, 'numerator')
            && \property_exists($rawValue, 'denominator')
            && \is_int($rawValue->numerator)
            && \is_int($rawValue->denominator);
    }

    #[\Override]
    protected function getFieldDefinition() : ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                'numerator',
                Container::Int()->notNull(),
                static function(\stdClass $number) : int {
                    return $number->numerator;
                },
            ),
            ResolvableField::create(
                'denominator',
                Container::Int()->notNull(),
                static function(\stdClass $number) : int {
                    return $number->denominator;
                },
            )->addDirective(
                $this->constraintDirectiveAccessor->getInt(),
                ['min' => 1],
            ),
        ]);
    }
}
