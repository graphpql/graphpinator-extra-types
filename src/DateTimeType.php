<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes;

final class DateTimeType extends \Graphpinator\Type\ScalarType
{
    protected const NAME = 'DateTime';
    protected const DESCRIPTION = 'DateTime type - string which contains valid date in "<YYYY>-<MM>-<DD> <HH>:<MM>:<SS>" format.';

    public function validateNonNullValue(mixed $rawValue) : bool
    {
        return \is_string($rawValue)
            && \Nette\Utils\DateTime::createFromFormat('Y-m-d H:i:s', $rawValue) instanceof \Nette\Utils\DateTime;
    }
}
