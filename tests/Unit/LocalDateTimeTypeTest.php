<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class LocalDateTimeTypeTest extends \PHPUnit\Framework\TestCase
{
    public function simpleDataProvider() : array
    {
        return [
            ['2013-04-12 16:40:00'],
            ['2008-01-30 23:05:59'],
        ];
    }

    public function invalidDataProvider() : array
    {
        return [
            ['2008-01-30T24:05:60-01:11'],
            ['2010-404-01 12:50:50'],
            ['2010-01-404 12:50:50'],
            ['01-01-42042 12:50:50'],
            ['2010-31-01 23:59:59'],
            ['2010-28-02 24:00:00'],
            ['2010-29-02 12:10:55'],
            ['2010-30-04 12:12:12'],
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
            ['2010-01-01'],
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
        $dateTime = new \Graphpinator\ExtraTypes\LocalDateTimeType();
        $value = $dateTime->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));

        self::assertSame($dateTime, $value->getType());
        self::assertSame($rawValue, $value->getRawValue());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param int|bool|string|float|array $rawValue
     */
    public function testValidateValueInvalid($rawValue) : void
    {
        $this->expectException(\Graphpinator\Exception\Value\InvalidValue::class);

        $dateTime = new \Graphpinator\ExtraTypes\LocalDateTimeType();
        $dateTime->accept(new \Graphpinator\Resolver\CreateResolvedValueVisitor($rawValue));
    }
}
