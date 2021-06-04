<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class TimeTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['2013-04-12T16:40:00-04:00'],
            ['2008-01-56T66:05:80-01:11'],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
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
        $time = new \Graphpinator\ExtraTypes\TimeType();
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

        $time = new \Graphpinator\ExtraTypes\TimeType();
        $time->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
