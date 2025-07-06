<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\ScalarType;
use Infinityloop\Utils\Json;

final class JsonType extends ScalarType
{
    protected const NAME = 'Json';
    protected const DESCRIPTION = 'Json type - string which contains valid JSON.';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc7159');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        try {
            return \is_string($rawValue)
                && Json::fromString($rawValue)->toNative();
        } catch (\JsonException) {
            return false;
        }
    }
}
