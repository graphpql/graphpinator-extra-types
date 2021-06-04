<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class PhoneNumberType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'PhoneNumber';
    protected const DESCRIPTION = 'PhoneNumber type - string which contains valid phone number.'
        . \PHP_EOL . 'The accepted format is without spaces and other special characters, but the leading plus is required.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3966#section-5.1');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \preg_match('/(\+{1}[0-9]{1,3}[0-9]{8,9})/', $rawValue) === 1;
    }
}
