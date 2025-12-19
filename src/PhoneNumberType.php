<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('PhoneNumber type - string which contains valid phone number.' . \PHP_EOL . 'The accepted format is without spaces and other special characters, but the leading plus is required.')]
final class PhoneNumberType extends ScalarType
{
    protected const NAME = 'PhoneNumber';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3966#section-5.1');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && \preg_match('/(\+{1}[0-9]{1,3}[0-9]{8,9})/', $rawValue) === 1 // @phpstan-ignore theCodingMachineSafe.function
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
