--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\Not;
use Respect\Validation\Rules\NoWhitespace;
use Respect\Validation\Validator;

try {
    $validator = new Validator();
    $validator->addRule(new Not(new NoWhitespace()));
    $validator->check('ABC');
} catch (Exception $exception) {
    echo get_class($exception).':'.$exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
Respect\Validation\Exceptions\NotException:"ABC" must contain whitespace
