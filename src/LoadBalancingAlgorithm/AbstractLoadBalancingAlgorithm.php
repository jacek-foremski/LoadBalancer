<?php
declare(strict_types = 1);

namespace LoadBalancer\LoadBalancingAlgorithm;

use LoadBalancer\Exception\InvalidArgumentException;
use LoadBalancer\Host\HostInterface;

abstract class AbstractLoadBalancingAlgorithm implements LoadBalancingAlgorithmInterface
{
    /**
     * @var HostInterface[]
     */
    protected $hosts;

    public function __construct(array $hosts)
    {
        if ($this->isArrayOfHosts($hosts)) {
            $this->hosts = array_values($hosts);
        } else {
            throw new InvalidArgumentException('HostInterface[]');
        }
    }

    private function isArrayOfHosts($hosts) : bool
    {
        if (empty($hosts)) {
            return false;
        }

        foreach ($hosts as $host) {
            if (!is_object($host) || !in_array(HostInterface::class, class_implements(get_class($host)), true)) {
                return false;
            }
        }

        return true;
    }

}