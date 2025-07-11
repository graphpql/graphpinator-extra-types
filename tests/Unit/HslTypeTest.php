<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\Tests\Integration\TestDIContainer;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class HslTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [(object) ['hue' => 360, 'saturation' => 100, 'lightness' => 100]],
            [(object) ['hue' => 0, 'saturation' => 0, 'lightness' => 0]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50]],
            [(object) ['hue' => 150, 'saturation' => 20, 'lightness' => 80]],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [(object) ['hue' => 150, 'lightness' => 80]],
            [(object) ['hue' => 150, 'saturation' => 20]],
            [(object) ['hue' => null, 'saturation' => 20, 'lightness' => 80]],
            [(object) ['hue' => 150, 'saturation' => null, 'lightness' => 80]],
            [(object) ['hue' => 150, 'saturation' => 20, 'lightness' => null]],
            [(object) ['hue' => 150.42, 'saturation' => 20, 'lightness' => 80]],
            [(object) ['hue' => 150, 'saturation' => 20.42, 'lightness' => 80]],
            [(object) ['hue' => 150, 'saturation' => 20, 'lightness' => 80.42]],
            [(object) ['hue' => 'beetlejuice', 'saturation' => 50, 'lightness' => 50]],
            [(object) ['hue' => 180, 'saturation' => 'beetlejuice', 'lightness' => 50]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 'beetlejuice']],
            [(object) ['hue' => [], 'saturation' => 50, 'lightness' => 50]],
            [(object) ['hue' => 180, 'saturation' => [], 'lightness' => 50]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => []]],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param array $rawValue
     */
    public function testValidateValue($rawValue) : void
    {
        $hsl = TestDIContainer::getType('Hsl');
        $value = $hsl->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($hsl, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $hsl = TestDIContainer::getType('Hsl');
        $hsl->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
