<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests;

use Graphpinator\ConstraintDirectives\ConstraintDirectiveAccessor;
use Graphpinator\ConstraintDirectives\FloatConstraintDirective;
use Graphpinator\ConstraintDirectives\IntConstraintDirective;
use Graphpinator\ConstraintDirectives\ListConstraintDirective;
use Graphpinator\ConstraintDirectives\ListConstraintInput;
use Graphpinator\ConstraintDirectives\ObjectConstraintDirective;
use Graphpinator\ConstraintDirectives\ObjectConstraintInput;
use Graphpinator\ConstraintDirectives\StringConstraintDirective;
use Graphpinator\ExtraTypes\AnyType;
use Graphpinator\ExtraTypes\BigIntType;
use Graphpinator\ExtraTypes\DateTimeType;
use Graphpinator\ExtraTypes\DateType;
use Graphpinator\ExtraTypes\EmailAddressType;
use Graphpinator\ExtraTypes\GpsInput;
use Graphpinator\ExtraTypes\GpsType;
use Graphpinator\ExtraTypes\HslInput;
use Graphpinator\ExtraTypes\HslType;
use Graphpinator\ExtraTypes\HslaInput;
use Graphpinator\ExtraTypes\HslaType;
use Graphpinator\ExtraTypes\IPv4Type;
use Graphpinator\ExtraTypes\IPv6Type;
use Graphpinator\ExtraTypes\JsonType;
use Graphpinator\ExtraTypes\MacType;
use Graphpinator\ExtraTypes\PhoneNumberType;
use Graphpinator\ExtraTypes\PointInput;
use Graphpinator\ExtraTypes\PointType;
use Graphpinator\ExtraTypes\PostalCodeType;
use Graphpinator\ExtraTypes\RgbInput;
use Graphpinator\ExtraTypes\RgbType;
use Graphpinator\ExtraTypes\RgbaInput;
use Graphpinator\ExtraTypes\RgbaType;
use Graphpinator\ExtraTypes\TimeType;
use Graphpinator\ExtraTypes\UrlType;
use Graphpinator\ExtraTypes\VoidType;
use Graphpinator\SimpleContainer;
use Graphpinator\Typesystem\Container;
use Nette\StaticClass;

final class TestDIContainer
{
    use StaticClass;

    private static array $types = [];
    private static ?ConstraintDirectiveAccessor $accessor = null;
    private static ?Container $container = null;

    public static function getTypeContainer() : Container
    {
        return new SimpleContainer([
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
            'Gps' => self::getType('Gps'),
            'GpsInput' => self::getType('GpsInput'),
            'Point' => self::getType('Point'),
            'PointInput' => self::getType('PointInput'),
            'BigInt' => self::getType('BigInt'),
        ], [
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
            'Any' => new AnyType(),
            'DateTime' => new DateTimeType(),
            'Date' => new DateType(),
            'EmailAddress' => new EmailAddressType(),
            'Hsla' => new HslaType(
                self::getAccessor(),
            ),
            'HslaInput' => new HslaInput(
                self::getAccessor(),
            ),
            'Hsl' => new HslType(
                self::getAccessor(),
            ),
            'HslInput' => new HslInput(
                self::getAccessor(),
            ),
            'Ipv4' => new IPv4Type(),
            'Ipv6' => new IPv6Type(),
            'Json' => new JsonType(),
            'Mac' => new MacType(),
            'PhoneNumber' => new PhoneNumberType(),
            'PostalCode' => new PostalCodeType(),
            'Rgba' => new RgbaType(
                self::getAccessor(),
            ),
            'RgbaInput' => new RgbaInput(
                self::getAccessor(),
            ),
            'Rgb' => new RgbType(
                self::getAccessor(),
            ),
            'RgbInput' => new RgbInput(
                self::getAccessor(),
            ),
            'Time' => new TimeType(),
            'Url' => new UrlType(),
            'Void' => new VoidType(),
            'Gps' => new GpsType(
                self::getAccessor(),
            ),
            'GpsInput' => new GpsInput(
                self::getAccessor(),
            ),
            'Point' => new PointType(),
            'PointInput' => new PointInput(),
            'BigInt' => new BigIntType(),
            'ListConstraintInput' => new ListConstraintInput(
                self::getAccessor(),
            ),
            'ObjectConstraintInput' => new ObjectConstraintInput(
                self::getAccessor(),
            ),
            'stringConstraint' => new StringConstraintDirective(
                self::getAccessor(),
            ),
            'intConstraint' => new IntConstraintDirective(
                self::getAccessor(),
            ),
            'floatConstraint' => new FloatConstraintDirective(
                self::getAccessor(),
            ),
            'listConstraint' => new ListConstraintDirective(
                self::getAccessor(),
            ),
            'objectConstraint' => new ObjectConstraintDirective(
                self::getAccessor(),
            ),
        };

        return self::$types[$name];
    }

    public static function getAccessor() : ConstraintDirectiveAccessor
    {
        if (self::$accessor === null) {
            self::$accessor = new class implements ConstraintDirectiveAccessor
            {
                public function getString() : StringConstraintDirective
                {
                    return TestDIContainer::getType('stringConstraint');
                }

                public function getInt() : IntConstraintDirective
                {
                    return TestDIContainer::getType('intConstraint');
                }

                public function getFloat() : FloatConstraintDirective
                {
                    return TestDIContainer::getType('floatConstraint');
                }

                public function getList() : ListConstraintDirective
                {
                    return TestDIContainer::getType('listConstraint');
                }

                public function getListInput() : ListConstraintInput
                {
                    return TestDIContainer::getType('ListConstraintInput');
                }

                public function getObject() : ObjectConstraintDirective
                {
                    return TestDIContainer::getType('objectConstraint');
                }

                public function getObjectInput() : ObjectConstraintInput
                {
                    return TestDIContainer::getType('ObjectConstraintInput');
                }
            };
        }

        return self::$accessor;
    }
}
