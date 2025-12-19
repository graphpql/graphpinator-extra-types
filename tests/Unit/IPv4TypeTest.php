<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\IPv4Type;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class IPv4TypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['255.255.255.255'],
            ['0.0.0.0'],
            ['128.0.1.1'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['420.255.255.255'],
            ['255.420.255.255'],
            ['255.255.420.255'],
            ['255.255.255.420'],
            ['255.FF.255.255'],
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
        $ipv4 = new IPv4Type();
        $value = $ipv4->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($ipv4, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $ipv4 = new IPv4Type();
        $ipv4->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new IPv4Type();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc4001#section-3', $type->getSpecifiedByUrl());
    }
}
