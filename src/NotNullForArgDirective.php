<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Directive;
use Graphpinator\Typesystem\Field\Field;
use Graphpinator\Typesystem\Location\FieldDefinitionLocation;
use Graphpinator\Typesystem\NotNullType;
use Graphpinator\Value\ArgumentValueSet;
use Graphpinator\Value\FieldValue;
use Graphpinator\Value\NullValue;
use Graphpinator\Value\ResolvedValue;

final class NotNullForArgDirective extends Directive implements
    FieldDefinitionLocation
{
    protected const NAME = 'notNullForArg';
    protected const DESCRIPTION = 'Field guarantees it wont return null when the condition is met.';

    public function __construct(
        private AnyType $anyType,
    )
    {
    }

    public function validateFieldUsage(
        Field $field,
        ArgumentValueSet $arguments,
    ) : bool
    {
        // field has argument with given name and has nullable type
        return $field->getArguments()->offsetExists($arguments->offsetGet('name')->getValue()->getRawValue())
            && !$field->getType() instanceof NotNullType;
    }

    public function validateVariance(
        ?ArgumentValueSet $biggerSet,
        ?ArgumentValueSet $smallerSet,
    ) : void
    {
        if ($biggerSet instanceof ArgumentValueSet &&
            $smallerSet instanceof ArgumentValueSet &&
            $biggerSet->isSame($smallerSet)) {
            return;
        }

        throw new \Exception();
    }

    public function resolveFieldDefinitionStart(
        ArgumentValueSet $arguments,
        ResolvedValue $parentValue,
    ) : void
    {
        // nothing here
    }

    public function resolveFieldDefinitionBefore(
        ArgumentValueSet $arguments,
        ResolvedValue $parentValue,
        ArgumentValueSet $fieldArguments,
    ) : void
    {
        // nothing here
    }

    public function resolveFieldDefinitionAfter(
        ArgumentValueSet $arguments,
        ResolvedValue $resolvedValue,
        ArgumentValueSet $fieldArguments,
    ) : void
    {
        if (!$resolvedValue instanceof NullValue) {
            return;
        }

        $argName = $arguments->offsetGet('name')->getValue()->getRawValue();
        $requiredValue = $arguments->offsetGet('equals')->getValue()->getRawValue();
        $providedValue = $fieldArguments->offsetGet($argName)->getValue()->getRawValue();

        if ($requiredValue === $providedValue) {
            throw new \Exception();
        }
    }

    public function resolveFieldDefinitionValue(
        ArgumentValueSet $arguments,
        FieldValue $fieldValue,
    ) : void
    {
        // nothing here
    }

    protected function getFieldDefinition() : ArgumentSet
    {
        return new ArgumentSet([
            Argument::create(
                'name',
                Container::String()->notNull(),
            )->setDescription('Name of argument in question.'),
            Argument::create(
                'equals',
                $this->anyType,
            )->setDescription('Value for which the field guarantees it does not return null.'),
        ]);
    }
}
