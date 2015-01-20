<?php

namespace Respect\Validation;

use PHPUnit_Framework_TestCase;

class TestCase extends PHPUnit_Framework_TestCase
{
    protected function getMockRule()
    {
        return $this->getMock('Respect\\Validation\\Rules\\RuleInterface');
    }

    protected function getResultMock()
    {
        return $this->getMock('Respect\\Validation\\Result');
    }

    protected function getFactoryMock()
    {
        return $this->getMock('Respect\\Validation\\Factory');
    }
}
