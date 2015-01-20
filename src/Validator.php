<?php
/*
 * This file is part of Respect\Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
namespace Respect\Validation;

use Respect\Validation\Exceptions\AbstractCompositeException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\AllOf;

class Validator extends AllOf
{
    protected static $defaultFactory;
    protected $factory;
    protected $name;

    public function __construct(Factory $factory = null)
    {
        $this->factory = $factory ?: static::getDefaultFactory();
    }

    public static function getDefaultFactory()
    {
        if (null === static::$defaultFactory) {
            static::$defaultFactory = new Factory();
        }

        return static::$defaultFactory;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function __callStatic($ruleName, array $arguments)
    {
        $validator = new static();
        $validator->__call($ruleName, $arguments);

        return $validator;
    }

    public function __call($ruleName, array $arguments)
    {
        $rule = $this->factory->rule($ruleName, $arguments);

        $this->addRule($rule);

        return $this;
    }

    private function isEmpty($input)
    {
        return (null === $input);
    }

    /**
     * @param mixed  $input
     * @param Result $result
     *
     * @return boolean
     */
    public function validate($input)
    {
        if ($this->isEmpty($input)) {
            return true;
        }

        $result = $this->factory->result($this, $input);
        $result->setParam('name', $this->getName());
        $result->applyRule();

        return $result->isValid();
    }

    /**
     * @param mixed  $input
     * @param Result $result
     *
     * @throws ValidationException
     *
     * @return null
     */
    public function check($input)
    {
        if ($this->isEmpty($input)) {
            return;
        }

        $result = $this->factory->result($this, $input);
        foreach ($this->getRules() as $childRule) {
            $childResult = $result->createChild($childRule, $input);
            $childResult->appendTo($result);
            $childResult->setParam('name', $this->getName());
            $childResult->applyRule();

            if ($childResult->isValid()) {
                continue;
            }

            $result->setValid(false);

            throw $this->factory->exception($childResult);
        }
    }

    /**
     * @param mixed  $input
     * @param Result $result
     *
     * @throws AbstractCompositeException
     *
     * @return null
     */
    public function assert($input)
    {
        if ($this->isEmpty($input)) {
            return;
        }

        $result = $this->factory->result($this, $input);
        $result->setParam('name', $this->getName());
        $result->applyRule();
        if ($result->isValid()) {
            return;
        }

        throw $this->factory->exception($result);
    }
}
