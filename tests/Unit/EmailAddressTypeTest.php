<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\EmailAddressType;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class EmailAddressTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['test@test.com'],
            ['test@test.cz'],
            ['test@test.eu'],
            ['test@test.sk'],
            ['test@test.org'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['testtest.org'],
            ['test@testcom'],
            ['@test.com'],
            ['test.com'],
            ['@'],
            ['test@.com'],
            ['test@test'],
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
        $email = new EmailAddressType();
        $value = $email->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($email, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $email = new EmailAddressType();
        $email->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new EmailAddressType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc5322#section-3.4.1', $type->getSpecifiedByUrl());
    }
}
