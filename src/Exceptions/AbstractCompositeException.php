<?php
/*
 * This file is part of Respect\Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
namespace Respect\Validation\Exceptions;

use RecursiveIteratorIterator;
use Respect\Validation\Iterators\ResultIterator;

class AbstractCompositeException extends ValidationException
{
    private function getPrefix($level)
    {
        if (0 === $level) {
            return '';
        }

        return str_repeat(' ', $level);
    }

    public function getFullMessage()
    {
        $resultIterator = new ResultIterator($this->getResult());
        $messages = array($this->getPrefix($this->level).$this->getMessage());
        foreach ($resultIterator as $result) {
            if ($result->isValid()) {
                continue;
            }
            $exception = $this->getResult()->getFactory()->exception($result);
            $exception->setLevel($this->level + 1);
            $messages[] = $this->getPrefix($this->level + 1).$exception->getMainMessage();
        }

        return implode(PHP_EOL, array_filter($messages));
    }
}
