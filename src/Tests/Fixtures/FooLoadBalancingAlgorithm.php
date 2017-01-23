<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\Fixtures;

use LoadBalancer\Host\HostInterface;
use LoadBalancer\LoadBalancingAlgorithm\LoadBalancingAlgorithmInterface;

class FooLoadBalancingAlgorithm implements LoadBalancingAlgorithmInterface
{
    /**
     * @var HostInterface[]
     */
    private $hosts;

    public function __construct(array $hosts)
    {
        $this->hosts = $hosts;
    }

    public function nextHost() : HostInterface
    {
        return $this->hosts[0];
    }
}