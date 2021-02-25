<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class AnyTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            [2**12],
            ['string'], // otherwise its float for some reason
            [2.35],
            [false],
            [null],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
            [[]],
            [new \stdClass()],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param mixed $rawValue
     */
    public function testValidateValue(mixed $rawValue) : void
    {
        $dateTime = new \Graphpinator\ExtraTypes\AnyType();
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

        $dateTime = new \Graphpinator\ExtraTypes\AnyType();
        $dateTime->createInputedValue($rawValue);
    }
}
