<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;

final class UUIDType extends ScalarType
{
    protected const NAME = 'UUID';
    protected const DESCRIPTION = 'UUID type - string which contains valid UUID (universally unique identifier).';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc4122');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \preg_match('/^{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}}?$/', $rawValue) === 1;
    }
}
