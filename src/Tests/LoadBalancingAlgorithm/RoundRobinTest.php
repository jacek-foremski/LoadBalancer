<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\LoadBalancingAlgorithm;

use LoadBalancer\Host\HostInterface;
use LoadBalancer\LoadBalancingAlgorithm\RoundRobin;
use PHPUnit\Framework\TestCase;

class RoundRobinTest extends TestCase
{
    /**
     * @var HostInterface
     */
    private $host1;

    /**
     * @var HostInterface
     */
    private $host2;

    public function testNextHostForOneHost()
    {
        $hosts = array($this->host1);
        $roundRobin = new RoundRobin($hosts);

        $this->assertSame($this->host1, $roundRobin->nextHost());
        $this->assertSame($this->host1, $roundRobin->nextHost());
    }

    public function testNextHostForSeveralHosts()
    {
        $hosts = array($this->host1, $this->host2);
        $roundRobin = new RoundRobin($hosts);

        $this->assertSame($this->host1, $roundRobin->nextHost());
        $this->assertSame($this->host2, $roundRobin->nextHost());
        $this->assertSame($this->host1, $roundRobin->nextHost());
        $this->assertSame($this->host2, $roundRobin->nextHost());
    }

    public function testHostsWithoutCorrectIndices()
    {
        $hosts = array(10 => $this->host1, 'asdfghjkl' => $this->host2);
        $roundRobin = new RoundRobin($hosts);

        $this->assertSame($this->host1, $roundRobin->nextHost());
    }

    protected function setUp()
    {
        $this->host1 = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->host2 = $this->getMockBuilder(HostInterface::class)->getMock();
    }
}
