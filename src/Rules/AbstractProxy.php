<?php

namespace Respect\Validation\Rules;

/**
 * Base class for proxy rules.
 */
abstract class AbstractProxy implements RuleInterface
{
    /**
     * @var RuleInterface
     */
    protected $rule;

    /**
     * @param RuleInterface $rule
     */
    public function __construct(RuleInterface $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return RuleInterface
     */
    public function getRule()
    {
        return $this->rule;
    }
}
