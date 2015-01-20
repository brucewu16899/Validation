<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Default interface for rules.
 */
interface RuleInterface
{
    /**
     * Apply rule on $input to Result.
     *
     * @param mixed  $input
     * @param Result $result
     *
     * @return null
     */
    public function apply($input, Result $result);
}
