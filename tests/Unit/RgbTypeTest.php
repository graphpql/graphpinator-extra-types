<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\Tests\TestDIContainer;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class RgbTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [(object) ['red' => 255, 'green' => 255, 'blue' => 255]],
            [(object) ['red' => 0, 'green' => 0, 'blue' => 0]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 50]],
            [(object) ['red' => 150, 'green' => 20, 'blue' => 80]],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [(object) ['green' => 20, 'blue' => 80]],
            [(object) ['red' => 150, 'blue' => 80]],
            [(object) ['red' => 150, 'green' => 20]],
            [(object) ['red' => null, 'green' => 20, 'blue' => 80]],
            [(object) ['red' => 150, 'green' => null, 'blue' => 80]],
            [(object) ['red' => 150, 'green' => 20, 'blue' => null]],
            [(object) ['red' => 150.42, 'green' => 20, 'blue' => 80]],
            [(object) ['red' => 150, 'green' => 20.42, 'blue' => 80]],
            [(object) ['red' => 150, 'green' => 20, 'blue' => 80.42]],
            [(object) ['red' => 'beetlejuice', 'green' => 50, 'blue' => 50]],
            [(object) ['red' => 180, 'green' => 'beetlejuice', 'blue' => 50]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => 'beetlejuice']],
            [(object) ['red' => [], 'green' => 50, 'blue' => 50]],
            [(object) ['red' => 180, 'green' => [], 'blue' => 50]],
            [(object) ['red' => 180, 'green' => 50, 'blue' => []]],
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
        $rgb = TestDIContainer::getType('Rgb');
        $value = $rgb->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($rgb, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $rgb = TestDIContainer::getType('Rgb');
        $rgb->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
