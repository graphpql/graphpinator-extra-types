<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\TimeType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class TimeTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['T16:40:00-04:00'],
            ['T23:05:59-01:11'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['T40:85:90-01:11'],
            ['T24:61:60-1:11'],
            ['120:10:55'],
            ['12:100:55'],
            ['12:10:550'],
            ['00:00:00'],
            ['23:59:59'],
            ['24:00:00'],
            ['12:10:55'],
            ['12:12:12'],
            ['00:00:55'],
            ['1210:55'],
            ['12:1055'],
            [':00:00'],
            ['00:00'],
            ['0:00'],
            [':00'],
            ['00'],
            ['0'],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param string $rawValue
     */
    public function testValidateValue(string $rawValue) : void
    {
        $time = new TimeType();
        $value = $time->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($time, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $time = new TimeType();
        $time->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new TimeType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6', $type->getSpecifiedByUrl());
    }
}
