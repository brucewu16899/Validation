--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

try {
    v::notEmpty()
     ->noWhitespace()
     ->setName('Something')
     ->check(' a  ');
} catch (Exception $exception) {
    echo get_class($exception).':'.$exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
Respect\Validation\Exceptions\NoWhitespaceException:Something must not contain whitespace
