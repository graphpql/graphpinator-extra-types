<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class IPv4Type extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Ipv4';
    protected const DESCRIPTION = 'Ipv4 type - string which contains valid IPv4 address.';

    public function __construct()
    {
        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc4001#section-3');

        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (bool) \filter_var($rawValue, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV4);
    }
}
