<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class LocalDateTimeType extends \Graphpinator\Typesystem\ScalarType
{
    use \Graphpinator\ExtraTypes\Trait\TDateTimeValidate;

    protected const NAME = 'LocalDateTime';
    // @phpcs:ignore SlevomatCodingStandard.Files.LineLength.LineTooLong
    protected const DESCRIPTION = 'LocalDateTime type - string which contains valid date in "YYYY-MM-DD HH:MM:SS" format (without timezone information).';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue) && $this->isValid($rawValue, 'Y-m-d H:i:s');
    }
}
