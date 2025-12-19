<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('LocalTimeEnd type - string which contains time in "HH:MM:SS" format (without timezone information), including a special 24:00:00 value for usage in intervals.')]
final class LocalTimeEndType extends ScalarType
{
    protected const NAME = 'LocalTimeEnd';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        if (!\is_string($rawValue)) {
            return null;
        }

        $dateTime = BaseDateType::validate($rawValue, 'H:i:s');

        return $dateTime instanceof \DateTimeImmutable || $rawValue === '24:00:00'
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
