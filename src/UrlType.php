<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class UrlType extends \Graphpinator\Typesystem\ScalarType
{
    protected const NAME = 'Url';
    protected const DESCRIPTION = 'Url type - string which contains valid URL (Uniform Resource Locator).';

    public function __construct()
    {
        parent::__construct();

        $this->setSpecifiedBy('https://datatracker.ietf.org/doc/html/rfc3986');
    }

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && (bool) \filter_var($rawValue, \FILTER_VALIDATE_URL);
    }
}
