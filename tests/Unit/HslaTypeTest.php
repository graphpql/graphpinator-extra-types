<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\Tests\Integration\TestDIContainer;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class HslaTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [(object) ['hue' => 360, 'saturation' => 100, 'lightness' => 100, 'alpha' => 1.0]],
            [(object) ['hue' => 0, 'saturation' => 0, 'lightness' => 0, 'alpha' => 0.0]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 150, 'saturation' => 20, 'lightness' => 80, 'alpha' => 0.8]],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [(object) ['saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50]],
            [(object) ['hue' => null, 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => null, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => null, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50, 'alpha' => null]],
            [(object) ['hue' => 180.42, 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50.42, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50.42, 'alpha' => 0.5]],
            [(object) ['hue' => 'beetlejuice', 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 'beetlejuice', 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 'beetlejuice', 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50, 'alpha' => 'beetlejuice']],
            [(object) ['hue' => [], 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => [], 'lightness' => 50, 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => [], 'alpha' => 0.5]],
            [(object) ['hue' => 180, 'saturation' => 50, 'lightness' => 50, 'alpha' => []]],
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
        $hsla = TestDIContainer::getType('Hsla');
        $value = $hsla->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($hsla, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $hsla = TestDIContainer::getType('Hsla');
        $hsla->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
