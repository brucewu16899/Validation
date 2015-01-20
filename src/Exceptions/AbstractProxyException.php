<?php

namespace Respect\Validation\Exceptions;

class AbstractProxyException extends ValidationException
{
    public function getMainMessage()
    {
        $result = current($this->getResult()->getChildren());
        if (! $result) {
            return parent::getMainMessage();
        }

        $exception = $this->getFactory()->exception($result);

        return $exception->getMainMessage();
    }
}
