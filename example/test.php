<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hug\Security\Security as Security;

/* ************************************************* */
/* ************* Security::get_payload ************* */
/* ************************************************* */

// $test = Security::get_payload($url = 'https://hugo.maugey.fr', $uid = 54, $role = 'user', $demo = false);


/* ************************************************* */
/* ************* Security::clean_input ************* */
/* ************************************************* */

// $input = $this->valid_input;
// $test = Security::clean_input($input);

/* ************************************************* */
/* ************* Security::sanitize ************* */
/* ************************************************* */

// $input = $this->valid_input;
// $test = Security::sanitize($input);

/* ************************************************* */
/* ************* Security::password ************* */
/* ************************************************* */

$test = Security::password(10);
echo $test . "\n";

$test = Security::password(15, true);
echo $test . "\n";

$test = Security::password('coucou', true);
echo $test . "\n";

$test = Security::password(4, true);
echo $test . "\n";
