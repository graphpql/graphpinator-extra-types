<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('UUID type - string which contains valid UUID (universally unique identifier).')]
final class UUIDType extends ScalarType
{
    protected const NAME = 'UUID';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc4122');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && \preg_match('/^{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}}?$/', $rawValue) === 1 // @phpstan-ignore theCodingMachineSafe.function
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
