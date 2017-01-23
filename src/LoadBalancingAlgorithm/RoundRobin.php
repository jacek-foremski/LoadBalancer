<?php
declare(strict_types = 1);

namespace LoadBalancer\LoadBalancingAlgorithm;

use LoadBalancer\Host\HostInterface;

class RoundRobin extends AbstractLoadBalancingAlgorithm
{
    /**
     * @var integer
     */
    private $nextHostIndex = 0;

    public function nextHost() : HostInterface
    {
        $host = $this->hosts[$this->nextHostIndex];

        $this->nextHostIndex++;
        $this->nextHostIndex %= count($this->hosts);

        return $host;
    }
}