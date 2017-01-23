<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\Fixtures;

use LoadBalancer\Host\HostInterface;
use LoadBalancer\Request\Request;

class FooHost implements HostInterface
{
    public function getLoad() : float
    {
    }

    public function handleRequest(Request $request) : void
    {
    }
}