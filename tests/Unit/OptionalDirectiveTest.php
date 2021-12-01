<?php

declare(strict_types = 1);

namespace Graphpinator\ExtraTypes\Tests\Unit;

final class OptionalDirectiveTest extends \PHPUnit\Framework\TestCase
{
    public function testValue() : void
    {
        $value = self::getInput()->accept(
            new \Graphpinator\Value\ConvertRawValueVisitor((object) ['arg1' => 'Value'], new \Graphpinator\Common\Path()),
        );
        $value->applyVariables(new \Graphpinator\Normalizer\VariableValueSet([]));

        self::assertInstanceOf(\Graphpinator\Value\InputValue::class, $value);
    }

    public function testOmitted() : void
    {
        $value = self::getInput()->accept(
            new \Graphpinator\Value\ConvertRawValueVisitor((object) [], new \Graphpinator\Common\Path()),
        );
        $value->applyVariables(new \Graphpinator\Normalizer\VariableValueSet([]));

        self::assertInstanceOf(\Graphpinator\Value\InputValue::class, $value);
    }

    public function testInvalid() : void
    {
        $this->expectException(\Graphpinator\Exception\GraphpinatorBase::class);
        $this->expectExceptionMessage('Input field is @optional and therefore cannot contain null value.');

        $value = self::getInput()->accept(
            new \Graphpinator\Value\ConvertRawValueVisitor((object) ['arg1' => null], new \Graphpinator\Common\Path()),
        );
        $value->applyVariables(new \Graphpinator\Normalizer\VariableValueSet([]));
    }

    private static function getInput() : \Graphpinator\Typesystem\InputType
    {
        return new class extends \Graphpinator\Typesystem\InputType {
            protected const NAME = 'ConstraintInput';

            protected function getFieldDefinition() : \Graphpinator\Typesystem\Argument\ArgumentSet
            {
                return new \Graphpinator\Typesystem\Argument\ArgumentSet([
                    \Graphpinator\Typesystem\Argument\Argument::create(
                        'arg1',
                        \Graphpinator\Typesystem\Container::String(),
                    )->addDirective(new \Graphpinator\ExtraTypes\OptionalDirective()),
                ]);
            }
        };
    }
}
