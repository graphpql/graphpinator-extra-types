<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class BigIntTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            [2**62],
            [(int) 2**63], // otherwise its float for some reason
            [(int) -2**63],
            [(int) \PHP_INT_MAX],
            [0],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
            [2**64],
            ['0'],
            [true],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param int $rawValue
     */
    public function testValidateValue(int $rawValue) : void
    {
        $dateTime = new \Graphpinator\ExtraTypes\BigIntType();
        $value = $dateTime->createInputedValue($rawValue);

        self::assertSame($dateTime, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $dateTime = new \Graphpinator\ExtraTypes\BigIntType();
        $dateTime->createInputedValue($rawValue);
    }
}
