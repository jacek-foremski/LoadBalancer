<?php
declare(strict_types = 1);

namespace LoadBalancer\LoadBalancingAlgorithm;

use LoadBalancer\Host\HostInterface;

interface LoadBalancingAlgorithmInterface
{
    public function __construct(array $hosts);

    public function nextHost() : HostInterface;
}