<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class IPv4TypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['255.255.255.255'],
            ['0.0.0.0'],
            ['128.0.1.1'],
        ];
    }

    public function invalidDataProvider() : array
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
        $ipv4 = new \Graphpinator\ExtraTypes\IPv4Type();
        $value = $ipv4->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc4001#section-3', $ipv4->getSpecifiedByUrl());
        self::assertSame($ipv4, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $ipv4 = new \Graphpinator\ExtraTypes\IPv4Type();
        $ipv4->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
