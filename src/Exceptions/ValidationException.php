<?php

namespace Respect\Validation\Exceptions;

use Exception;
use Respect\Validation\Result;

class ValidationException extends Exception implements ExceptionInterface
{
    const MESSAGE_STANDARD  = 0;

    const MODE_AFFIRMATIVE  = Result::MODE_AFFIRMATIVE;
    const MODE_NEGATIVE     = Result::MODE_NEGATIVE;

    /**
     * @var array
     */
    protected $defaultTemplates = array(
        self::MODE_AFFIRMATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must be valid',
        ),
        self::MODE_NEGATIVE => array(
            self::MESSAGE_STANDARD => '{{label}} must not be valid',
        ),
    );

    /**
     * @var Result
     */
    protected $result;

    /**
     * @var int
     */
    protected $level = 0;

    /**
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->result = $result;

        parent::__construct($this->getMainMessage());
    }

    public function setLevel($level)
    {
        $this->level  = $level;
    }

    public function getResult()
    {
        return  $this->result;
    }

    public function getMode()
    {
        return $this->getResult()->getMode();
    }

    protected function getFactory()
    {
        return $this->getResult()->getFactory();
    }

    public function getTemplate()
    {
        $mode = $this->getMode();
        $template = $this->getResult()->getParam('template') ?: self::MESSAGE_STANDARD;
        if (is_string($template)) {
            return $template;
        }

        if (isset($this->defaultTemplates[$mode][$template])) {
            return $this->defaultTemplates[$mode][$template];
        }

        return $this->defaultTemplates[self::MODE_AFFIRMATIVE][self::MESSAGE_STANDARD];
    }

    private function formatMessage($template, array $params)
    {
        return preg_replace_callback(
            '/{{(\w+)}}/',
            function ($match) use ($params) {
                return isset($params[$match[1]]) ? $params[$match[1]] : $match[0];
            },
            $template
        );
    }

    public function getMainMessage()
    {
        $template = $this->getTemplate();

        $params = $this->result->toArray();
        if (isset($params['name'])) {
            return $this->formatMessage($template, array('label' => $params['name']) + $params);
        }

        $value = $params['value'];
        if (is_array($value)) {
            $value = 'Array';
        }

        return $this->formatMessage($template, array('label' => '"'.$value.'"') + $params);
    }
}
