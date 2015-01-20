<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Will validate if all inner validators validates.
 */
class AllOf extends AbstractComposite
{
    /**
     * {@inheritDoc}
     */
    public function apply($input, Result $result)
    {
        foreach ($this->getRules() as $childRule) {
            $childResult = $result->createChild($childRule, $input);
            $childResult->applyRule();

            $result->setValid($result->isValid() && $childResult->isValid());
        }
    }
}
