<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;
use Infinityloop\Utils\Json;

/**
 * @extends ScalarType<Json>
 */
#[Description('Json type - string which contains valid JSON.')]
final class JsonType extends ScalarType
{
    protected const NAME = 'Json';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc7159');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?Json
    {
        if (!\is_string($rawValue)) {
            return null;
        }

        try {
            $json = Json::fromString($rawValue);
            $json->toNative(); // trigger decoding

            return $json;
        } catch (\JsonException) {
            return null;
        }
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue->toString();
    }
}
