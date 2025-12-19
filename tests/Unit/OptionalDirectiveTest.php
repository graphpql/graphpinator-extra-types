<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

use Graphpinator\Common\Path;
use Graphpinator\Exception\GraphpinatorBase;
use Graphpinator\ExtraTypes\OptionalDirective;
use Graphpinator\Normalizer\VariableValueSet;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;
use Graphpinator\Value\InputValue;
use Graphpinator\Value\Visitor\ConvertRawValueVisitor;
use PHPUnit\Framework\TestCase;

final class OptionalDirectiveTest extends TestCase
{
    public function testValue() : void
    {
        $value = self::getInput()->accept(
            new ConvertRawValueVisitor((object) ['arg1' => 'Value'], new Path()),
        );
        $value->applyVariables(new VariableValueSet([]));

        self::assertInstanceOf(InputValue::class, $value);
    }

    public function testOmitted() : void
    {
        $value = self::getInput()->accept(
            new ConvertRawValueVisitor((object) [], new Path()),
        );
        $value->applyVariables(new VariableValueSet([]));

        self::assertInstanceOf(InputValue::class, $value);
    }

    public function testInvalid() : void
    {
        $this->expectException(GraphpinatorBase::class);
        $this->expectExceptionMessage('Input field is @optional and therefore cannot contain null value.');

        $value = self::getInput()->accept(
            new ConvertRawValueVisitor((object) ['arg1' => null], new Path()),
        );
        $value->applyVariables(new VariableValueSet([]));
    }

    private static function getInput() : InputType
    {
        return new class extends InputType {
            protected const NAME = 'ConstraintInput';

            protected function getFieldDefinition() : ArgumentSet
            {
                return new ArgumentSet([
                    Argument::create(
                        'arg1',
                        Container::String(),
                    )->addDirective(new OptionalDirective()),
                ]);
            }
        };
    }
}
