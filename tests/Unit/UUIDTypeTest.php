<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class UUIDTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['A98C5A1E-A742-4808-96FA-6F409E799937'],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
            [''],
            ['A98C5A1E-A742-4808-96FA-6F409E799937A'],
            ['A98C5A1E-A742-4808-96FA-6F409E799937-'],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [(object) []],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param string $rawValue
     */
    public function testValidateValue(string $rawValue) : void
    {
        $type = new \Graphpinator\ExtraTypes\UUIDType();
        $value = $type->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($type, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $ipv4 = new \Graphpinator\ExtraTypes\UUIDType();
        $ipv4->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new \Graphpinator\ExtraTypes\UUIDType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc4122', $type->getSpecifiedByUrl());
    }
}
