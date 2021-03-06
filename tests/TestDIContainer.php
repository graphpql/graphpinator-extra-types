<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests;

final class TestDIContainer
{
    use \Nette\StaticClass;

    private static array $types = [];
    private static ?\Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor $accessor = null;
    private static ?\Graphpinator\Container\Container $container = null;

    public static function getTypeContainer() : \Graphpinator\Container\Container
    {
        return new \Graphpinator\Container\SimpleContainer([
            'Any' => self::getType('Any'),
            'DateTime' => self::getType('DateTime'),
            'Date' => self::getType('Date'),
            'EmailAddress' => self::getType('EmailAddress'),
            'Hsla' => self::getType('Hsla'),
            'HslaInput' => self::getType('HslaInput'),
            'Hsl' => self::getType('Hsl'),
            'HslInput' => self::getType('HslInput'),
            'Ipv4' => self::getType('Ipv4'),
            'Ipv6' => self::getType('Ipv6'),
            'Json' => self::getType('Json'),
            'Mac' => self::getType('Mac'),
            'PhoneNumber' => self::getType('PhoneNumber'),
            'PostalCode' => self::getType('PostalCode'),
            'Rgba' => self::getType('Rgba'),
            'RgbaInput' => self::getType('RgbaInput'),
            'Rgb' => self::getType('Rgb'),
            'RgbInput' => self::getType('RgbInput'),
            'Time' => self::getType('Time'),
            'Url' => self::getType('Url'),
            'Void' => self::getType('Void'),
            'Upload' => self::getType('Upload'),
            'Gps' => self::getType('Gps'),
            'GpsInput' => self::getType('GpsInput'),
            'Point' => self::getType('Point'),
            'PointInput' => self::getType('PointInput'),
            'BigInt' => self::getType('BigInt'),
        ],[
            'ListConstraintInput' => self::getType('ListConstraintInput'),
            'stringConstraint' => self::getType('stringConstraint'),
            'intConstraint' => self::getType('intConstraint'),
            'floatConstraint' => self::getType('floatConstraint'),
            'listConstraint' => self::getType('listConstraint'),
            'objectConstraint' => self::getType('objectConstraint'),
        ]);
    }

    public static function getType(string $name) : object
    {
        if (\array_key_exists($name, self::$types)) {
            return self::$types[$name];
        }

        self::$types[$name] = match ($name) {
            'Any' => new \Graphpinator\ExtraTypes\AnyType(),
            'DateTime' => new \Graphpinator\ExtraTypes\DateTimeType(),
            'Date' => new \Graphpinator\ExtraTypes\DateType(),
            'EmailAddress' => new \Graphpinator\ExtraTypes\EmailAddressType(),
            'Hsla' => new \Graphpinator\ExtraTypes\HslaType(
                self::getAccessor(),
            ),
            'HslaInput' => new \Graphpinator\ExtraTypes\HslaInput(
                self::getAccessor(),
            ),
            'Hsl' => new \Graphpinator\ExtraTypes\HslType(
                self::getAccessor(),
            ),
            'HslInput' => new \Graphpinator\ExtraTypes\HslInput(
                self::getAccessor(),
            ),
            'Ipv4' => new \Graphpinator\ExtraTypes\IPv4Type(),
            'Ipv6' => new \Graphpinator\ExtraTypes\IPv6Type(),
            'Json' => new \Graphpinator\ExtraTypes\JsonType(),
            'Mac' => new \Graphpinator\ExtraTypes\MacType(),
            'PhoneNumber' => new \Graphpinator\ExtraTypes\PhoneNumberType(),
            'PostalCode' => new \Graphpinator\ExtraTypes\PostalCodeType(),
            'Rgba' => new \Graphpinator\ExtraTypes\RgbaType(
                self::getAccessor(),
            ),
            'RgbaInput' => new \Graphpinator\ExtraTypes\RgbaInput(
                self::getAccessor(),
            ),
            'Rgb' => new \Graphpinator\ExtraTypes\RgbType(
                self::getAccessor(),
            ),
            'RgbInput' => new \Graphpinator\ExtraTypes\RgbInput(
                self::getAccessor(),
            ),
            'Time' => new \Graphpinator\ExtraTypes\TimeType(),
            'Url' => new \Graphpinator\ExtraTypes\UrlType(),
            'Void' => new \Graphpinator\ExtraTypes\VoidType(),
            'Upload' => new \Graphpinator\Module\Upload\UploadType(),
            'Gps' => new \Graphpinator\ExtraTypes\GpsType(
                self::getAccessor(),
            ),
            'GpsInput' => new \Graphpinator\ExtraTypes\GpsInput(
                self::getAccessor(),
            ),
            'Point' => new \Graphpinator\ExtraTypes\PointType(),
            'PointInput' => new \Graphpinator\ExtraTypes\PointInput(),
            'BigInt' => new \Graphpinator\ExtraTypes\BigIntType(),
            'ListConstraintInput' => new \Graphpinator\ConstraintDirectives\ListConstraintInput(
                self::getAccessor(),
            ),
            'stringConstraint' => new \Graphpinator\ConstraintDirectives\StringConstraintDirective(
                self::getAccessor(),
            ),
            'intConstraint' => new \Graphpinator\ConstraintDirectives\IntConstraintDirective(
                self::getAccessor(),
            ),
            'floatConstraint' => new \Graphpinator\ConstraintDirectives\FloatConstraintDirective(
                self::getAccessor(),
            ),
            'listConstraint' => new \Graphpinator\ConstraintDirectives\ListConstraintDirective(
                self::getAccessor(),
            ),
            'objectConstraint' => new \Graphpinator\ConstraintDirectives\ObjectConstraintDirective(
                self::getAccessor(),
            ),
        };

        return self::$types[$name];
    }

    public static function getAccessor() : \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor
    {
        if (self::$accessor === null) {
            self::$accessor = new class implements \Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor
            {
                public function getString() : \Graphpinator\ConstraintDirectives\StringConstraintDirective
                {
                    return TestDIContainer::getType('stringConstraint');
                }

                public function getInt() : \Graphpinator\ConstraintDirectives\IntConstraintDirective
                {
                    return TestDIContainer::getType('intConstraint');
                }

                public function getFloat() : \Graphpinator\ConstraintDirectives\FloatConstraintDirective
                {
                    return TestDIContainer::getType('floatConstraint');
                }

                public function getList() : \Graphpinator\ConstraintDirectives\ListConstraintDirective
                {
                    return TestDIContainer::getType('listConstraint');
                }

                public function getListInput() : \Graphpinator\ConstraintDirectives\ListConstraintInput
                {
                    return TestDIContainer::getType('ListConstraintInput');
                }

                public function getObject() : \Graphpinator\ConstraintDirectives\ObjectConstraintDirective
                {
                    return TestDIContainer::getType('objectConstraint');
                }
            };
        }

        return self::$accessor;
    }
}
