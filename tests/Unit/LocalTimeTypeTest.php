<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class LocalTimeTypeTest extends \PHPUnit\Framework\TestCase
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
        $time = new \Graphpinator\ExtraTypes\LocalTimeType();
        $value = $time->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($time, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $time = new \Graphpinator\ExtraTypes\LocalTimeType();
        $time->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
