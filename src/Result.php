<?php
/*
 * This file is part of Respect\Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
namespace Respect\Validation;

use Respect\Validation\Rules\RuleInterface;

class Result
{
    const MODE_AFFIRMATIVE  = 1;
    const MODE_NEGATIVE     = 2;

    /**
     * @var RuleInterface
     */
    protected $rule;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var int
     */
    protected $mode = self::MODE_AFFIRMATIVE;

    /**
     * @var boolean
     */
    protected $isValid = true;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var array
     */
    protected $params = array();

    /**
     * @var Result[]
     */
    protected $children = array();

    /**
     * @param RuleInterface $rule
     * @param mixed         $value
     */
    public function __construct(RuleInterface $rule, $value, Factory $factory)
    {
        $this->rule     = $rule;
        $this->value    = $value;
        $this->factory  = $factory;
    }

    /**
     * @return RuleInterface
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Factory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @param boolean $isValid
     *
     * @return self
     */
    public function setValid($isValid)
    {
        $this->isValid = (boolean) $isValid;

        return $this;
    }

    /**
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     *
     * @return self
     */
    public function setMode($mode)
    {
        if (!in_array($mode, array(self::MODE_AFFIRMATIVE, self::MODE_NEGATIVE))) {
            throw new Exception();
        }
        $this->mode = $mode;

        return $this;
    }

    /**
     * @param string $name
     * @param mixed  $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null)
    {
        if (isset($this->params[$name])) {
            $defaultValue = $this->params[$name];
        }

        return $defaultValue;
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return self
     */
    public function setParam($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $defaultParams = array(
            'is_valid'  => $this->isValid(),
            'mode'      => $this->getMode(),
            'value'     => $this->getValue(),
        );

        return $defaultParams + $this->params;
    }

    public function applyRule()
    {
        $this->getRule()->apply($this->getValue(), $this);
    }

    /**
     * @param RuleInterface $rule
     * @param mixed         $value
     * @param boolean       $isValid
     */
    public function createChild(RuleInterface $rule, $value)
    {
        $child = $this->getFactory()->result($rule, $value);
        $child->appendTo($this);

        return $child;
    }

    /**
     * @param Result $result
     *
     * @return self
     */
    public function appendTo(Result $result)
    {
        $result->addChild($this);

        return $this;
    }

    /**
     * @param Result $child
     *
     * @return self
     */
    public function addChild(Result $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }
}
