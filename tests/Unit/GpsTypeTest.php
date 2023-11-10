<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class GpsTypeTest extends \PHPUnit\Framework\TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [(object) ['lat' => 0.0, 'lng' => 0.0]],
            [(object) ['lat' => -90.0, 'lng' => -180.0]],
            [(object) ['lat' => 90.0, 'lng' => 180.0]],
            [(object) ['lat' => 45.45, 'lng' => 90.90]],
            [(object) ['lat' => -45.45, 'lng' => -90.90]],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [(object) ['lat' => 0, 'lng' => 0.0]],
            [(object) ['lat' => 0.0, 'lng' => 0]],
            [(object) ['lat' => 0.0, 'lng' => null]],
            [(object) ['lat' => null, 'lng' => 0.0]],
            [(object) ['lat' => 0.0, 'lng' => 'string']],
            [(object) ['lat' => 'string', 'y' => 0.0]],
            [(object) ['lng' => 90.0]],
            [(object) ['lat' => 45.0]],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    public static function constraintDataProvider() : array
    {
        return [
            [(object) ['lat' => -90.1, 'lng' => 0.0]],
            [(object) ['lat' => 90.1, 'lng' => 0.0]],
            [(object) ['lat' => 0.0, 'lng' => -180.1]],
            [(object) ['lat' => 0.0, 'lng' => 180.1]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param \stdClass $rawValue
     */
    public function testValidateValue(\stdClass $rawValue) : void
    {
        $gps = \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Gps');
        $value = $gps->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($gps, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array|\stdClass $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $gps = \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Gps');
        $gps->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
