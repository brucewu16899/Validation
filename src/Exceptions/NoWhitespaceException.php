<?php

namespace Respect\Validation\Exceptions;

class NoWhitespaceException extends ValidationException
{
    /**
     * @var array
     */
    protected $defaultTemplates = array(
        self::MODE_AFFIRMATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must not contain whitespace',
        ),
        self::MODE_NEGATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must contain whitespace',
        ),
    );
}
