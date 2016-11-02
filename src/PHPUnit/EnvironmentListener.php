<?php

namespace wolxxx\PHPUnit;

/**
 * Class EnvironmentListener
 *
 * @package wolxxx\PHPUnit
 */
class EnvironmentListener extends \PHPUnit_Framework_BaseTestListener implements \PHPUnit_Framework_TestListener
{
    /**
     * @inheritDoc
     */
    public function startTest(\PHPUnit_Framework_Test $test)
    {
        $extendedEnvironmentArguments = [];
        $arguments                    = $_SERVER['argv'];
        foreach ($arguments as $argument) {
            $acceptedStart = '--custom_';
            if ($acceptedStart !== substr($argument, 0, strlen($acceptedStart))) {
                continue;
            }
            $argument = str_replace($acceptedStart, '', $argument);
            list($key, $value) = explode('=', $argument, 2);
            $extendedEnvironmentArguments[$key] = $value;
        }
        $_ENV['extendedEnvironmentArguments'] = $extendedEnvironmentArguments;
    }
}