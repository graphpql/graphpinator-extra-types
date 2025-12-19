<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\JsonType;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class JsonTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['{"class":"test"}'],
            ['{"testName":"testValue"}'],
            ['[]'],
        ];
    }

    public static function invalidDataProvider() : array
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
        $json = new JsonType();
        $value = $json->accept(new CreateResolvedValueVisitor($rawValue));

        self::assertSame($json, $value->getType());
        self::assertSame($rawValue, $value->jsonSerialize());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array|object $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $json = new JsonType();
        $json->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new JsonType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc7159', $type->getSpecifiedByUrl());
    }
}
