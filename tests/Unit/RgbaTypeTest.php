<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\Tests\Integration\TestDIContainer;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class RgbaTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [(object) ['red' => 255, 'green' => 255, 'blue' => 255, 'alpha' => 1.0]],
            [(object) ['red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0.0]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 150, 'green' => 20, 'blue' => 80, 'alpha' => 0.8]],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [(object) ['green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50]],
            [(object) ['red' => null, 'green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => null, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => null, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50, 'alpha' => null]],
            [(object) ['red' => 180.42, 'green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50.42, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50.42, 'alpha' => 0.5]],
            [(object) ['red' => 'beetlejuice', 'green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 'beetlejuice', 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 'beetlejuice', 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50, 'alpha' => 'beetlejuice']],
            [(object) ['red' => [], 'green' => 50, 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => [], 'blue' => 50, 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => [], 'alpha' => 0.5]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50, 'alpha' => []]],
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
        $rgba = TestDIContainer::getType('Rgba');
        $value = $rgba->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($rgba, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $rgba = TestDIContainer::getType('Rgba');
        $rgba->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
