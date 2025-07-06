<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\UUIDType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class UUIDTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['A98C5A1E-A742-4808-96FA-6F409E799937'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [''],
            ['AA98C5A1E-A742-4808-96FA-6F409E799937'],
            ['A98C5A1E-A742-4808-96FA-6F409E799937A'],
            ['-A98C5A1E-A742-4808-96FA-6F409E799937'],
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
        $type = new UUIDType();
        $value = $type->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($type, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $ipv4 = new UUIDType();
        $ipv4->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new UUIDType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc4122', $type->getSpecifiedByUrl());
    }
}
