<?php

namespace JGimeno\TaskReporter\Tests\App;

use JGimeno\TaskReporter\App\Application;
use League\Container\Container;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public function testItReturnsTheContainer()
    {
        $container = new Container();
        $app = new Application($container);

        $this->assertInstanceOf(Container::class, $app->getContainer());
    }
}
