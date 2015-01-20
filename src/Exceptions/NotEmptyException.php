<?php

namespace Respect\Validation\Exceptions;

class NotEmptyException extends ValidationException
{
    /**
     * @var array
     */
    protected $defaultTemplates = array(
        self::MODE_AFFIRMATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must not be empty',
        ),
        self::MODE_NEGATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must be empty',
        ),
    );
}
