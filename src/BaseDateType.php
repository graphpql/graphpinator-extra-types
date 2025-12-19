<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<\DateTimeImmutable>
 */
abstract class BaseDateType extends ScalarType
{
    public function __construct(
        private readonly string $format,
    )
    {
        parent::__construct();
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?\DateTimeImmutable
    {
        return \is_string($rawValue)
            ? self::validate($rawValue, $this->format)
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue->format($this->format);
    }

    public static function validate(string $rawValue, string $format) : ?\DateTimeImmutable
    {
        $dateTime = \DateTimeImmutable::createFromFormat($format, $rawValue);
        $errors = \DateTimeImmutable::getLastErrors();

        return $dateTime instanceof \DateTimeImmutable && ($errors === false || ($errors['error_count'] === 0 && $errors['warning_count'] === 0))
            ? $dateTime
            : null;
    }
}
