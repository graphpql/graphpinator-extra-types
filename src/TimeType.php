<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class TimeType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Time';
    protected const DESCRIPTION = 'Time type - string which contains time in ISO8601 format.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        if (!\is_string($rawValue)) {
            return false;
        }

        $time = \Nette\Utils\DateTime::createFromFormat('\TH:i:sP', $rawValue);
        $errors = \DateTimeImmutable::getLastErrors();

        return $time instanceof \Nette\Utils\DateTime
            && ($errors === false || ($errors['error_count'] === 0 && $errors['warning_count'] === 0));
    }
}
