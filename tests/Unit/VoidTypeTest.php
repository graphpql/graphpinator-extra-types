<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Exception\Value\InvalidValue;
use Graphpinator\ExtraTypes\VoidType;
use Graphpinator\Resolver\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class VoidTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [null],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param void $rawValue
     */
    public function testValidateValue(mixed $rawValue) : void
    {
        $void = new VoidType();
        $value = $void->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($void, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $void = new VoidType();
        $void->accept(new CreateResolvedValueVisitor($rawValue));
    }
}
