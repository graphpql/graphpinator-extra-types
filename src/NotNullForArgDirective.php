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
use Graphpinator\Value\Contract\Value;
use Graphpinator\Value\FieldValue;
use Graphpinator\Value\NullValue;

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

    #[\Override]
    public function validateFieldUsage(
        Field $field,
        ArgumentValueSet $arguments,
    ) : bool
    {
        // field has argument with given name and has nullable type
        return $field->getArguments()->offsetExists($arguments->offsetGet('name')->value->getRawValue())
            && !$field->getType() instanceof NotNullType;
    }

    #[\Override]
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

    #[\Override]
    public function resolveFieldDefinitionStart(
        ArgumentValueSet $arguments,
        Value $parentValue,
    ) : void
    {
        // nothing here
    }

    #[\Override]
    public function resolveFieldDefinitionBefore(
        ArgumentValueSet $arguments,
        Value $parentValue,
        ArgumentValueSet $fieldArguments,
    ) : void
    {
        // nothing here
    }

    #[\Override]
    public function resolveFieldDefinitionAfter(
        ArgumentValueSet $arguments,
        Value $resolvedValue,
        ArgumentValueSet $fieldArguments,
    ) : void
    {
        if (!$resolvedValue instanceof NullValue) {
            return;
        }

        $argName = $arguments->offsetGet('name')->value->getRawValue();
        $requiredValue = $arguments->offsetGet('equals')->value->getRawValue();
        $providedValue = $fieldArguments->offsetGet($argName)->value->getRawValue();

        if ($requiredValue === $providedValue) {
            throw new \Exception();
        }
    }

    #[\Override]
    public function resolveFieldDefinitionValue(
        ArgumentValueSet $arguments,
        FieldValue $fieldValue,
    ) : void
    {
        // nothing here
    }

    #[\Override]
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
