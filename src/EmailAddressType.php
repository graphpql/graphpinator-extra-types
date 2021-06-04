<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class EmailAddressType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'EmailAddress';
    protected const DESCRIPTION = 'EmailAddress type - string which contains valid email address.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc5322#section-3.4.1');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (bool) \filter_var($rawValue, \FILTER_VALIDATE_EMAIL);
    }
}
