<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class NotNullForArgDirective extends \Graphpinator\Typesystem\Directive implements
    \Graphpinator\Typesystem\Location\FieldDefinitionLocation
{
    protected const NAME = 'notNullForArg';
    protected const DESCRIPTION = 'Field guarantees it wont return null when the condition is met.';

    public function __construct(
        private \Graphpinator\ExtraTypes\AnyType $anyType,
    )
    {
    }

    public function validateFieldUsage(
        \Graphpinator\Typesystem\Field\Field $field,
        \Graphpinator\Value\ArgumentValueSet $arguments,
    ) : bool
    {
        // field has argument with given name and has nullable type
        return $field->getArguments()->offsetExists($arguments->offsetGet('name')->getValue()->getRawValue())
            && !$field->getType() instanceof \Graphpinator\Typesystem\NotNullType;
    }

    public function validateVariance(
        ?\Graphpinator\Value\ArgumentValueSet $biggerSet,
        ?\Graphpinator\Value\ArgumentValueSet $smallerSet,
    ) : void
    {
        if ($biggerSet instanceof \Graphpinator\Value\ArgumentValueSet &&
            $smallerSet instanceof \Graphpinator\Value\ArgumentValueSet &&
            $biggerSet->isSame($smallerSet)) {
            return;
        }

        throw new \Exception();
    }

    public function resolveFieldDefinitionStart(
        \Graphpinator\Value\ArgumentValueSet $arguments,
        \Graphpinator\Value\ResolvedValue $parentValue,
    ) : void
    {
        // nothing here
    }

    public function resolveFieldDefinitionBefore(
        \Graphpinator\Value\ArgumentValueSet $arguments,
        \Graphpinator\Value\ResolvedValue $parentValue,
        \Graphpinator\Value\ArgumentValueSet $fieldArguments,
    ) : void
    {
        // nothing here
    }

    public function resolveFieldDefinitionAfter(
        \Graphpinator\Value\ArgumentValueSet $arguments,
        \Graphpinator\Value\ResolvedValue $resolvedValue,
        \Graphpinator\Value\ArgumentValueSet $fieldArguments,
    ) : void
    {
        if (!$resolvedValue instanceof \Graphpinator\Value\NullValue) {
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
        \Graphpinator\Value\ArgumentValueSet $arguments,
        \Graphpinator\Value\FieldValue $fieldValue,
    ) : void
    {
        // nothing here
    }

    protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
    {
        return new \Graphpinator\Typesystem\Argument\ArgumentSet([
            \Graphpinator\Typesystem\Argument\Argument::create(
                'name',
                \Graphpinator\Typesystem\Container::String()->notNull(),
            )->setDescription('Name of argument in question.'),
            \Graphpinator\Typesystem\Argument\Argument::create(
                'equals',
                $this->anyType,
            )->setDescription('Value for which the field guarantees it does not return null.'),
        ]);
    }
}
