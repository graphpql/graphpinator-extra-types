<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('EmailAddress type - string which contains valid email address.')]
final class EmailAddressType extends ScalarType
{
    protected const NAME = 'EmailAddress';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc5322#section-3.4.1');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && (bool) \filter_var($rawValue, \FILTER_VALIDATE_EMAIL)
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
