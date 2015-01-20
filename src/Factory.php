<?php
/*
 * This file is part of Respect\Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */
namespace Respect\Validation;

use ReflectionClass;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Iterators\ResultIterator;
use Respect\Validation\Rules\RuleInterface;

class Factory
{
    /**
     * @param string $name
     * @param array  $settings
     *
     * @return RuleInterface
     */
    public function rule($name, array $settings = array())
    {
        $className = 'Respect\\Validation\\Rules\\'.ucfirst($name);
        $reflection = new ReflectionClass($className);

        return $reflection->newInstanceArgs($settings);
    }

    /**
     * @param Result $result
     *
     * @return ValidationException
     */
    public function exception(Result $result)
    {
        $exceptionName = str_replace('\\Rules\\', '\\Exceptions\\', get_class($result->getRule()));
        $exceptionName .= 'Exception';

        return new $exceptionName($result);
    }

    /**
     * @return Result
     */
    public function result(RuleInterface $rule, $value)
    {
        return new Result($rule, $value, $this);
    }
}
