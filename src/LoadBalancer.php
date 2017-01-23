<?php
declare(strict_types = 1);

namespace LoadBalancer;

use LoadBalancer\Exception\InvalidArgumentException;
use LoadBalancer\LoadBalancingAlgorithm\LoadBalancingAlgorithmInterface;
use LoadBalancer\Request\Request;

class LoadBalancer
{
    /**
     * @var LoadBalancingAlgorithmInterface
     */
    private $loadBalancingAlgorithm;

    public function __construct(array $hosts, string $loadBalancingAlgorithmClass)
    {
        if ($this->isLoadBalancingAlgorithmClass($loadBalancingAlgorithmClass)) {
            $this->loadBalancingAlgorithm = new $loadBalancingAlgorithmClass($hosts);
        } else {
            throw new InvalidArgumentException('Name of Class implementing LoadBalancingAlgorithmInterface');
        }
    }

    private function isLoadBalancingAlgorithmClass($loadBalancingAlgorithmClass) : bool
    {
        return class_exists($loadBalancingAlgorithmClass) && in_array(LoadBalancingAlgorithmInterface::class, class_implements($loadBalancingAlgorithmClass), true);
    }

    public function handleRequest(Request $request) : void
    {
        $host = $this->loadBalancingAlgorithm->nextHost();
        $host->handleRequest($request);
    }
}