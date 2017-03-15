<?php

# For PHP7
// declare(strict_types=1);

// namespace Hug\Tests\Security;

use PHPUnit\Framework\TestCase;

use Hug\Security\Security as Security;

/**
 * 
 */
final class SecurityTest extends TestCase
{
    public $valid_input;
    public $invalid_input;

    function __construct()
    {
        $this->valid_input = file_get_contents(__DIR__ . '/../../data/hugo-maugey-fr-valid.html');
        $this->invalid_input = file_get_contents(__DIR__ . '/../../data/hugo-maugey-fr-invalid.html');
    }

    /* ************************************************* */
    /* ************* Security::get_payload ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanGetPayload()
    {
        $test = Security::get_payload($url = 'https://hugo.maugey.fr', $uid = 54, $role = 'user', $demo = false);
        $this->assertInternalType('array', $test);
    }

    /**
     *
     */
    public function testCannotGetPayload()
    {
        $test = Security::get_payload($url = 'hugo.maugey.fr', $uid = null, $role = null, $demo = true);
        $this->assertInternalType('array', $test);

    }

    /* ************************************************* */
    /* ************* Security::clean_input ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanCleanInput()
    {
        $input = $this->valid_input;
        $test = Security::clean_input($input);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    public function testCannotCleanInput()
    {
        $input = $this->invalid_input;
        $test = Security::clean_input($input);
        $this->assertInternalType('string', $test);
    }

    /* ************************************************* */
    /* ************* Security::sanitize ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanGetSanitize()
    {
        $input = $this->valid_input;
        $test = Security::sanitize($input);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    public function testCannotSanitize()
    {
        $input = $this->invalid_input;
        $test = Security::sanitize($input);
        $this->assertInternalType('string', $test);

    }

}
