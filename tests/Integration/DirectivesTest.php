<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Integration;

use \Infinityloop\Utils\Json;

final class DirectivesTest extends \PHPUnit\Framework\TestCase
{
    public static function simpleDataProvider() : array
    {
        return [
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": 50}") { hue saturation lightness } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslField' => ['hue' => 180, 'saturation' => 50, 'lightness' => 50],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": 50, \"alpha\": 0.5}") {
                        hue saturation lightness alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslaField' => ['hue' => 180, 'saturation' => 50, 'lightness' => 50, 'alpha' => 0.5],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 150, \"green\": 150, \"blue\": 150}") { red green blue } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbField' => ['red' => 150, 'green' => 150, 'blue' => 150],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaField(input: "{\"red\": 150, \"green\": 150, \"blue\": 150, \"alpha\": 0.5}") { red green blue alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbaField' => ['red' => 150, 'green' => 150, 'blue' => 150, 'alpha' => 0.5],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": 45.0, \"lng\": 90.0}") { lat lng } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'gpsField' => ['lat' => 45.0, 'lng' => 90.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { pointField(input: "{\"x\": 1.0, \"y\": 1.0}") { x y } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'pointField' => ['x' => 1.0, 'y' => 1.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { pointInput(input: {x: 1.0, y: 1.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'pointInput' => 1,
                    ],
                ]),
            ],
        ];
    }

    public static function edgeValuesDataProvider() : array
    {
        return [
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaField(input: "{\"hue\": 0, \"saturation\": 0, \"lightness\": 0, \"alpha\": 0.0}") {
                        hue saturation lightness alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslaField' => ['hue' => 0, 'saturation' => 0, 'lightness' => 0, 'alpha' => 0.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaField(input: "{\"hue\": 360, \"saturation\": 100, \"lightness\": 100, \"alpha\": 1.0}") {
                        hue saturation lightness alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslaField' => ['hue' => 360, 'saturation' => 100, 'lightness' => 100, 'alpha' => 1.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaField(input: "{\"red\": 0, \"green\": 0, \"blue\": 0, \"alpha\": 0.0}") {
                        red green blue alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbaField' => ['red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaField(input: "{\"red\": 255, \"green\": 255, \"blue\": 255, \"alpha\": 1.0}") {
                        red green blue alpha } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbaField' => ['red' => 255, 'green' => 255, 'blue' => 255, 'alpha' => 1.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": 90.0, \"lng\": 180.0}") { lat lng } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'gpsField' => ['lat' => 90.0, 'lng' => 180.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": -90.0, \"lng\": -180.0}") { lat lng } }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'gpsField' => ['lat' => -90.0, 'lng' => -180.0],
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaInput(input: {hue: 0, saturation: 0, lightness: 0, alpha: 0.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslaInput' => 1,
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaInput(input: {hue: 360, saturation: 100, lightness: 100, alpha: 1.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'hslaInput' => 1,
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaInput(input: {red: 0, green: 0, blue: 0, alpha: 0.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbaInput' => 1,
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaInput(input: {red: 255, green: 255, blue: 255, alpha: 1.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'rgbaInput' => 1,
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: 90.0, lng: 180.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'gpsInput' => 1,
                    ],
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: -90.0, lng: -180.0}) }',
                ]),
                Json::fromNative((object) [
                    'data' => [
                        'gpsInput' => 1,
                    ],
                ]),
            ],
        ];
    }

    public static function invalidDataProvider() : array
    {
        return [
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": -1, \"saturation\": 50, \"lightness\": 50}") {
                        hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 361, \"saturation\": 50, \"lightness\": 50}") {
                        hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 180, \"saturation\": -1, \"lightness\": 50}") {
                        hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 180, \"saturation\": 101, \"lightness\": 50}") { hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": -1}") {
                        hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": 101}") {
                        hue saturation lightness } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": 50, \"alpha\": -0.1}") {
                        hue saturation lightness alpha } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaField(input: "{\"hue\": 180, \"saturation\": 50, \"lightness\": 50, \"alpha\": 1.1}") {
                        hue saturation lightness alpha } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": -1, \"green\": 150, \"blue\": 150}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 256, \"green\": 150, \"blue\": 150}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 150, \"green\": -1, \"blue\": 150}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 150, \"green\": 256, \"blue\": 150}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 150, \"green\": 150, \"blue\": -1}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbField(input: "{\"red\": 150, \"green\": 150, \"blue\": 256}") { red green blue } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaField(input: "{\"red\": 150, \"green\": 150, \"blue\": 150, \"alpha\": -0.1}") {
                        red green blue alpha } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaField(input: "{\"red\": 150, \"green\": 150, \"blue\": 150, \"alpha\": 1.1}") {
                        red green blue alpha } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": -90.1, \"lng\": 90.0}") { lat lng } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": 90.1, \"lng\": 90.0}") { lat lng } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": 45.0, \"lng\": -180.1}") { lat lng } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsField(input: "{\"lat\": 45.0, \"lng\": 180.1}") { lat lng } }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: -1, saturation: 50, lightness: 50}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: 361, saturation: 50, lightness: 50}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: 180, saturation: -1, lightness: 50}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: 180, saturation: 101, lightness: 50}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: 180, saturation: 50, lightness: -1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslInput(input: {hue: 180, saturation: 50, lightness: 101}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaInput(input: {hue: 180, saturation: 50, lightness: 50, alpha: -0.1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { hslaInput(input: {hue: 180, saturation: 50, lightness: 50, alpha: 1.1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: -1, green: 150, blue: 150}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: 256, green: 150, blue: 150}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: 150, green: -1, blue: 150}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: 150, green: 256, blue: 150}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: 150, green: 150, blue: -1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbInput(input: {red: 150, green: 150, blue: 256}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaInput(input: {red: 150, green: 150, blue: 150, alpha: -0.1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { rgbaInput(input: {red: 150, green: 150, blue: 150, alpha: 1.1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: -90.1, lng: 90}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: 90.1, lng: 90}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: 45, lng: -180.1}) }',
                ]),
            ],
            [
                Json::fromNative((object) [
                    'query' => 'query { gpsInput(input: {lat: 45, lng: 180.1}) }',
                ]),
            ],
        ];
    }

    /**
     * @dataProvider simpleDataProvider
     * @dataProvider edgeValuesDataProvider
     * @param \Infinityloop\Utils\Json $request
     * @param \Infinityloop\Utils\Json $expected
     */
    public function testSimple(Json $request, Json $expected) : void
    {
        $graphpinator = $this->getGraphpinator();
        $result = $graphpinator->run(new \Graphpinator\Request\JsonRequestFactory($request));

        self::assertSame($expected->toString(), $result->toString());
    }

    /**
     * @dataProvider invalidDataProvider
     * @param \Infinityloop\Utils\Json $request
     */
    public function testInvalid(Json $request) : void
    {
        $this->expectException(\Graphpinator\ConstraintDirectives\Exception\ConstraintError::class);

        $graphpinator = $this->getGraphpinator();
        $graphpinator->run(new \Graphpinator\Request\JsonRequestFactory($request));
    }

    private function getGraphpinator() : \Graphpinator\Graphpinator
    {
        return new \Graphpinator\Graphpinator(
            new \Graphpinator\Typesystem\Schema(
                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getTypeContainer(),
                new class extends \Graphpinator\Typesystem\Type {
                    public function validateNonNullValue(mixed $rawValue) : bool
                    {
                        return true;
                    }

                    protected function getFieldDefinition() : \Graphpinator\Typesystem\Field\ResolvableFieldSet
                    {
                        return new \Graphpinator\Typesystem\Field\ResolvableFieldSet([
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'hslField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Hsl'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'hslaField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Hsla'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'rgbField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Rgb'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'rgbaField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Rgba'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'gpsField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Gps'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'pointField',
                                \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Point'),
                                static function ($parent, string $input) : \stdClass {
                                    return \json_decode($input);
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('Json')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'hslInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('HslInput')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'hslaInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('HslaInput')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'rgbInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('RgbInput')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'rgbaInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('RgbaInput')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'gpsInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('GpsInput')->notNull(),
                                ),
                            ])),
                            \Graphpinator\Typesystem\Field\ResolvableField::create(
                                'pointInput',
                                \Graphpinator\Typesystem\Container::Int(),
                                static function ($parent, \stdClass $input) : int {
                                    return 1;
                                },
                            )->setArguments(new \Graphpinator\Typesystem\Argument\ArgumentSet([
                                \Graphpinator\Typesystem\Argument\Argument::create(
                                    'input',
                                    \Graphpinator\ExtraTypes\Tests\TestDIContainer::getType('PointInput')->notNull(),
                                ),
                            ])),
                        ]);
                    }
                },
            ),
        );
    }
}
