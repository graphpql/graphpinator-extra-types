<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class JsonTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['{"class":"test"}'],
            ['{"testName":"testValue"}'],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
            [['class' => "\xB1\x31"]],
            ['{class: test}'],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param string|array $rawValue
     */
    public function testValidateValue($rawValue) : void
    {
        $json = new \Graphpinator\ExtraTypes\JsonType();
        $value = $json->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($json, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array|object $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $json = new \Graphpinator\ExtraTypes\JsonType();
        $json->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));;
    }
}
