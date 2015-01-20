--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

try {
    v::notEmpty()
     ->noWhitespace()
     ->assert(' a  ');
} catch (Exception $exception) {
    echo get_class($exception).':'.$exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
Respect\Validation\ValidatorException:" a  " must be valid
