<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\PhoneNumberType;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class PhoneNumberTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['+420123456789'],
            ['+42012345678'],
            ['+42123456789'],
            ['+888123456789'],
            ['+88123456789'],
            ['+8123456789'],
            ['+88812345678'],
            ['+812345678'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['123456789'],
            ['12345678'],
            ['222123456789'],
            ['22123456789'],
            ['2123456789'],
            ['22212345678'],
            ['2212345678'],
            ['212345678'],
            ['+23456789'],
            ['+3456789'],
            ['+456789'],
            ['+56789'],
            ['+6789'],
            ['+789'],
            ['+89'],
            ['+9'],
            ['+'],
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
        $phoneNumber = new PhoneNumberType();
        $value = $phoneNumber->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($phoneNumber, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $phoneNumber = new PhoneNumberType();
        $phoneNumber->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new PhoneNumberType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc3966#section-5.1', $type->getSpecifiedByUrl());
    }
}
