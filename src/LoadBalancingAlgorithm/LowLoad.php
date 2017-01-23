<?php
declare(strict_types = 1);

namespace LoadBalancer\LoadBalancingAlgorithm;

use LoadBalancer\Host\HostInterface;

class LowLoad extends AbstractLoadBalancingAlgorithm
{
    /**
     * @var float
     */
    private const LOAD_TRESHOLD = 0.75;

    public function nextHost() : HostInterface
    {
        $chosenHost = $this->hosts[0];
        foreach ($this->hosts as $host) {
            if ($host->getLoad() <= self::LOAD_TRESHOLD) {
                return $host;
            } elseif ($host->getLoad() < $chosenHost->getLoad()) {
                $chosenHost = $host;
            }
        }

        return $chosenHost;
    }
}