<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\ExtraTypes\DateType;
use Graphpinator\Value\Exception\InvalidValue;
use Graphpinator\Value\Visitor\CreateResolvedValueVisitor;
use PHPUnit\Framework\TestCase;

final class DateTypeTest extends TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            ['2010-01-01'],
            ['2010-01-31'],
            ['2010-02-28'],
            ['2012-02-29'],
            ['2010-04-30'],
            ['2010-12-12'],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            ['2011-02-29'],
            ['404-01-2010 12:50:50'],
            ['01-404-2010 12:50:50'],
            ['01-01-42042 12:50:50'],
            ['01-01- 12:50:50'],
            ['01-01 12:50:50'],
            ['01-0 12:50:50'],
            ['01- 12:50:50'],
            ['0 12:50:50'],
            ['12:50:50'],
            ['2010-01-01 12:50:5'],
            ['2010-01-01 12:50:'],
            ['2010-01-01 12:50'],
            ['2010-01-01 12:5'],
            ['2010-01-01 12:'],
            ['2010-01-01 12'],
            ['2010-01-01 1'],
            ['420-01-2010'],
            ['01-420-2010'],
            ['2010-01-011'],
            ['2010-01-01 255:50:50'],
            ['2010-01-01 12:705:50'],
            ['2010-01-01 12:50:705'],
            [true],
            [420],
            [420.42],
            ['beetlejuice'],
            [[]],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @param string $rawValue
     */
    public function testValidateValue(string $rawValue) : void
    {
        $date = new DateType();
        $value = $date->accept(new CreateResolvedValueVisitor($rawValue));

        $objectValue = $value->getRawValue();
        \assert($objectValue instanceof \DateTimeImmutable);
        self::assertSame($objectValue->format('H'), '00');

        self::assertSame($date, $value->getType());
        self::assertSame($rawValue, $value->jsonSerialize());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(InvalidValue::class);

        $date = new DateType();
        $date->accept(new CreateResolvedValueVisitor($rawValue));
    }

    public function testSpecifiedBy() : void
    {
        $type = new DateType();

        self::assertSame('https://datatracker.ietf.org/doc/html/rfc3339#section-5.6', $type->getSpecifiedByUrl());
    }
}
