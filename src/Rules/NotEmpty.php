<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Validates if the given input is not empty.
 */
class NotEmpty implements RuleInterface
{
    /**
     * {@inheritDoc}
     */
    public function apply($input, Result $result)
    {
        $result->setValid(!empty($input));
    }
}
