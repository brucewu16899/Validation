<?php

namespace Respect\Validation;

use stdClass;

/**
 * @covers Respect\Validation\Result
 */
class ResultTest extends TestCase
{
    public function testShouldAcceptArgumentsOnConstructor()
    {
        $rule       = $this->getMockRule();
        $value      = new stdClass();
        $factory    = $this->getFactoryMock();

        $result     = new Result($rule, $value, $factory);

        $this->assertSame($rule, $result->getRule());
        $this->assertSame($value, $result->getValue());
        $this->assertSame($factory, $result->getFactory());
    }
}
