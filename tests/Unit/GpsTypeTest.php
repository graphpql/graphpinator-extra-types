<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\Tests\Integration\TestDIContainer;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class GpsTypeTest extends TestCase
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
        $gps = TestDIContainer::getType('Gps');
        $value = $gps->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($gps, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array|\stdClass $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $gps = TestDIContainer::getType('Gps');
        $gps->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
