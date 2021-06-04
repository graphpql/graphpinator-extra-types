<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class VoidTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            [null],
        ];
    }

    public function invalidDataProvider() : array
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
        $void = new \Graphpinator\ExtraTypes\VoidType();
        $value = $void->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($void, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid(mixed $rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $void = new \Graphpinator\ExtraTypes\VoidType();
        $void->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
