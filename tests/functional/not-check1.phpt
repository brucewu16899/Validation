--SKIPIF--
skip: Work in progress
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

try {
    v::not(v::notEmpty())->check('Whatever');
} catch (Exception $exception) {
    echo get_class($exception).':'.$exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
Respect\Validation\Exceptions\NotEmptyException:"Whatever" must be empty
