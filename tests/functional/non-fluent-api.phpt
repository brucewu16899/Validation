--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Rules\NoWhitespace;
use Respect\Validation\Validator;

$validator = new Validator();
$validator->setName('Something');
$validator->addRule(new NotEmpty());
$validator->addRule(new NoWhitespace());

try {
    $validator->check('   ');
} catch (Exception $exception) {
    echo get_class($exception).':'.$exception->getMessage().PHP_EOL;
}
?>
--EXPECTF--
Respect\Validation\Exceptions\NoWhitespaceException:Something must not contain whitespace
