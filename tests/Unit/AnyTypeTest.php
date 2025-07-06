<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\AnyType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class AnyTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [2 ** 12],
            ['string'], // otherwise its float for some reason
            [2.35],
            [false],
            [null],
        ];
    }

    public static function invalidDataProvider() : array
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
        $dateTime = new AnyType();
        $value = $dateTime->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($dateTime, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $dateTime = new AnyType();
        $dateTime->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
