<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class EmailAddressTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['test@test.com'],
            ['test@test.cz'],
            ['test@test.eu'],
            ['test@test.sk'],
            ['test@test.org'],
        ];
    }

    public function invalidDataProvider() : array
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
        $email = new \Graphpinator\ExtraTypes\EmailAddressType();
        $value = $email->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($email, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $email = new \Graphpinator\ExtraTypes\EmailAddressType();
        $email->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new \Graphpinator\ExtraTypes\EmailAddressType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc5322#section-3.4.1', $type->getSpecifiedByUrl());
    }
}
