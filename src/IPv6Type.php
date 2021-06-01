<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class IPv6Type extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Ipv6';
    protected const DESCRIPTION = 'Ipv6 type - string which contains valid IPv6 address.';

    public function __construct()
    {
        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc4291#section-2.2');

        parent::__construct();
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (bool) \filter_var($rawValue, \FILTER_VALIDATE_IP, \FILTER_FLAG_IPV6);
    }
}
