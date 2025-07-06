<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\PostalCodeType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class PostalCodeTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['123 45'],
            ['000 00'],
            ['999 99'],
            ['351 00'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['123 4'],
            ['abc 123 40'],
            ['123 40 abc'],
            ['123'],
            ['123'],
            ['12'],
            ['1'],
            ['23 45'],
            ['3 45'],
            ['23 456'],
            ['3 456'],
            ['23456'],
            ['2345 6'],
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
        $postalCode = new PostalCodeType();
        $value = $postalCode->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($postalCode, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $postalCode = new PostalCodeType();
        $postalCode->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
