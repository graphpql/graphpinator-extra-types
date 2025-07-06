<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\IPv6Type;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class IPv6TypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['AAAA:AAAA:AAAA:AAAA:AAAA:AAAA:AAAA:AAAA'],
            ['FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF'],
            ['0000:0000:0000:0000:0000:0000:0000:0000'],
            ['9999:9999:9999:9999:9999:9999:9999:9999'],
            ['aaaa:aaaa:aaaa:aaaa:aaaa:aaaa:aaaa:aaaa'],
            ['ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff'],
            ['2a00:6500:0000:0000:0000:0025:fa56:0026'],
            ['2a00:6500:0000:0000:0000:25:fa56:26'],
            ['2a00:6500:0:0:0:25:fa56:26'],
            ['2a00:6500:0::25:fa56:26'],
            ['2a00:6500::25:fa56:26'],
            ['::'],
            ['2a::'],
            ['2a:2a00::'],
            ['2a:2a00:2a00::'],
            ['2a:2a00:2a00:2a00::'],
            ['2a:2a00:2a00:2a00:2a00::'],
            ['2a:2a00:2a00:2a00:2a00:2a00::'],
            ['2a:2a00:2a00:2a00:2a00:2a00:2a00::'],
            ['2a:2a00:2a00:2a00:2a00:2a00:2a00:2a00'],
            ['002a:2a00:2a00:2a00:2a00:2a00:2a00:2a00'],
            ['0000:2a00:2a00:2a00:2a00:2a00:2a00:2a00'],
            ['::2a00:2a00:2a00:2a00:2a00:2a00:2a00'],
            ['::2a00:2a00:2a00:2a00:2a00:2a00'],
            ['::2a00:2a00:2a00:2a00:2a00'],
            ['::2a00:2a00:2a00:2a00'],
            ['::2a00:2a00:2a00'],
            ['::2a00:2a00'],
            ['::2a00'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['6500:0000:0000:0000:0025:fa56:0026'],
            ['0000:0000:0000:0025:fa56:0026'],
            ['0000:0000:0025:fa56:0026'],
            ['0000:0025:fa56:0026'],
            ['0025:fa56:0026'],
            ['fa56:0026'],
            ['0026'],
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
        $ipv6 = new IPv6Type();
        $value = $ipv6->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($ipv6, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $ipv6 = new IPv6Type();
        $ipv6->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new IPv6Type();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc4291#section-2.2', $type->getSpecifiedByUrl());
    }
}
