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
        return \is_string($rawValue)
            && \Nette\Utils\DateTime::createFromFormat('\TH:i:sP', $rawValue) instanceof \Nette\Utils\DateTime;
    }
}
