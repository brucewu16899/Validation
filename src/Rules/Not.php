<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Negates any rule.
 */
class Not extends AbstractProxy
{
    /**
     * {@inheritDoc}
     */
    public function apply($input, Result $result)
    {
        $childResult = $result->createChild($this->getRule(), $input);
        $childResult->applyRule();
        $childResult->setMode(Result::MODE_NEGATIVE);

        $result->setValid(!$childResult->isValid());
    }
}
