<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Validates if the given input is not blank.
 */
class NotBlank implements RuleInterface
{
    /**
     * {@inheritDoc}
     */
    public function apply($input, Result $result)
    {
        if (!is_array($input) && !is_string($input)) {
            $result->setValid(null === $input);

            return;
        }

        if (is_array($input)) {
            $input = array_filter($input, array($this, __FUNCTION__));
        }

        if (is_string($input)) {
            $input = trim($input);
        }

        $result->setValid(!empty($input));
    }
}
