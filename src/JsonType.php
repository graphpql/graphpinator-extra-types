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
        if (!\is_string($rawValue)) {
            return false;
        }

        try {
            Json::fromString($rawValue)->toNative();

            return true;
        } catch (\JsonException) {
            return false;
        }
    }
}
