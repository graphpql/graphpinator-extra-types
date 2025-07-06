<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Integration;

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
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\Type;

final class TestDIContainer
{
    private static array $types = [];
    private static ?ConstraintDirectiveAccessor $accessor = null;

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
            'Query' => self::getType('Query'),
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
            'Query' => self::getQuery(),
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

    private static function getQuery() : Type
    {
        return new class extends Type {
            protected const NAME = 'Query';

            public function validateNonNullValue(mixed $rawValue) : bool
            {
                return true;
            }

            protected function getFieldDefinition() : ResolvableFieldSet
            {
                return new ResolvableFieldSet([
                    ResolvableField::create(
                        'hslField',
                        TestDIContainer::getType('Hsl'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'hslaField',
                        TestDIContainer::getType('Hsla'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'rgbField',
                        TestDIContainer::getType('Rgb'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'rgbaField',
                        TestDIContainer::getType('Rgba'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'gpsField',
                        TestDIContainer::getType('Gps'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'pointField',
                        TestDIContainer::getType('Point'),
                        static function ($parent, string $input) : \stdClass {
                            return \json_decode($input);
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('Json')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'hslInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('HslInput')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'hslaInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('HslaInput')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'rgbInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('RgbInput')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'rgbaInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('RgbaInput')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'gpsInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('GpsInput')->notNull(),
                        ),
                    ])),
                    ResolvableField::create(
                        'pointInput',
                        Container::Int(),
                        static function ($parent, \stdClass $input) : int {
                            return 1;
                        },
                    )->setArguments(new ArgumentSet([
                        Argument::create(
                            'input',
                            TestDIContainer::getType('PointInput')->notNull(),
                        ),
                    ])),
                ]);
            }
        };
    }
}
