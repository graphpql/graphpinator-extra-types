<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('LocalTime type - string which contains time in "HH:MM:SS" format (without timezone information).')]
final class LocalTimeType extends ScalarType
{
    protected const NAME = 'LocalTime';

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && BaseDateType::validate($rawValue, 'H:i:s') instanceof \DateTimeImmutable
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
