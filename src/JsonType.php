<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class JsonType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'Json';
    protected const DESCRIPTION = 'Json type - string which contains valid JSON.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        try {
            return \is_string($rawValue)
                && \Infinityloop\Utils\Json::fromString($rawValue)->toNative();
        } catch (\JsonException $e) {
            return false;
        }
    }
}
