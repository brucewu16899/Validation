<?php

namespace Respect\Validation\Exceptions;

class NotBlankException extends ValidationException
{
    /**
     * @var array
     */
    protected $defaultTemplates = array(
        self::MODE_AFFIRMATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must not be blank',
        ),
        self::MODE_NEGATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must be blank',
        ),
    );
}
