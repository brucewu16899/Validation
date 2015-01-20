--SKIPIF--
skip: Work in progress
--FILE--
<?php
require 'vendor/autoload.php';


use Respect\Validation\Iterators\ResultIterator;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Rules\NoWhitespace;
use Respect\Validation\Rules\Not;
use Respect\Validation\Validator;

try {
    $validator = new Validator();
    $validator->setName('User data');
    $validator->addRule(new NotEmpty());
    $validator->addRule(new NoWhitespace());
    $validator->addRule(new Not(new NoWhitespace()));
    $validator->assert('');
} catch (Exception $e) {
    echo $e->getMainMessage();
}

?>
--EXPECTF--
