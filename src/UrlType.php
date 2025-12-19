<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

use Graphpinator\Typesystem\Attribute\Description;
use Graphpinator\Typesystem\ScalarType;

/**
 * @extends ScalarType<string>
 */
#[Description('Url type - string which contains valid URL (Uniform Resource Locator).')]
final class UrlType extends ScalarType
{
    protected const NAME = 'Url';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3986');
    }

    #[\Override]
    public function validateAndCoerceInput(mixed $rawValue) : ?string
    {
        return \is_string($rawValue) && (bool) \filter_var($rawValue, \FILTER_VALIDATE_URL)
            ? $rawValue
            : null;
    }

    #[\Override]
    public function coerceOutput(mixed $rawValue) : string
    {
        return $rawValue;
    }
}
