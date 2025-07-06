<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\LocalTimeType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class LocalTimeTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['16:40:00'],
            ['00:05:59'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['24:05:60'],
            ['T24:05:60-01:11'],
            ['120:10:55'],
            ['12:100:55'],
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
        $time = new LocalTimeType();
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

        $time = new LocalTimeType();
        $time->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
