<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('Ipv4 type - string which contains valid IPv4 address.')]
final class IPv4Type extends ScalarType
{
    protected const NAME = 'Ipv4';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc4001#section-3');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && (bool) \filter_var($rawValue, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4)
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
