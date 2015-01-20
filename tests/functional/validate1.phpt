--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(
    v::notEmpty()
     ->noWhitespace()
     ->validate('Respect')
);
?>
--EXPECTF--
bool(true)
