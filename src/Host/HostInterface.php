<?php
declare(strict_types = 1);

namespace LoadBalancer\Host;

use LoadBalancer\Request\Request;

interface HostInterface
{
    public function getLoad() : float;

    public function handleRequest(Request $request) : void;
}